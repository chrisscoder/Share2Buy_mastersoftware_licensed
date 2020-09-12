<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Designer;
use App\Models\Order;
use App\Mail\PaymentReceipt;
use App\Notifications\StripeError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // All data for the product list page is fetched via AJAX when the page is loaded.
        return view('product.index');
    }

    /**
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        $product->load('designer');
        $product->sizes = explode(';', $product->type_value);

        $latestProducts = Product::with('orders')
            ->where('designer_id', $product->designer->id)
            ->where('online', 1) // should this be checked ?
            ->where('id', '!=', $product->id)
            ->orderBy('updated_at','desc')
            ->take(2)->get();

        return view('product.show', compact('latestProducts', 'product'));
    }

    /**
     * Products json route
     * @return array
     */
    public function jsonProducts()
    {
        $now = Carbon::now();
        $products = Product::with('designer', 'ordersUnhandled')
            ->has('designer')
            ->where([
              ['end_date', '>', $now],
              ['price', '>', 0],
              ['online', '=', 1],
            ])
            ->get();

        foreach($products as $key => &$product) {

          $productOrders = 0;
          if (!empty($product->ordersUnhandled)) {
            foreach ($product->ordersUnhandled as $order) {
                $productOrders += $order->quantity;
            }

            if ($productOrders == 10) {
               $products->forget($key);
            }
          }

          $images = [];
          $images['sectionTopImage']['medium'] = $product->image('sectionTopImage', 'medium.1:1');
          $images['sectionTopImage']['small'] = $product->image('sectionTopImage', 'small.1:1');

          $product->images = $images;
          $product->headerImageAlt = generateAlt($product->headerImage);
          $product->sectionTopImageAlt = generateAlt($product->sectionTopImage);
          $product->enddate = Carbon::parse($product->end_date)->toW3cString();
          $product->append(['active', 'buyable', 'discount', 'priceIncCommission', 'url', 'orderCount', 'unhandledOrderCount']);
        }

        return $products->values();
    }

    /**
     * Orders
     * @param  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Redirect
     */
    public function orders($id)
    {

        if (!Auth::check()) {
            return redirect('notloggedin');
        }

        $orderReady = false;
        $productOrdersCharged = false;
        $hasOrders = false;
        $productActive = false;

        $orderReadyCount = 0;
        $productOrdersChargedCount = 0;
        $productOrdersApprovedCount = 0;
        $productOrdersTotal = 0;

        $coPrice = 0;
        $coPriceTotal = 0;
        $commision = 0;
        $commisionTotal = 0;
        $total = 0;

        $product = Product::where('id', $id)->first();
        $productOrders = Order::where('product_id', $id)->get();
        $orderCount = count($productOrders);
        $today = Carbon::now();

        $productSalePriod = [];
        $productSalePriod['start_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $product->start_date)->format('d M, Y - H.i');
        $productSalePriod['end_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $product->end_date)->format('d M, Y - H.i');
        $stripeLink = Session::get('stripe_link');

        foreach ($productOrders as $order) {
            if ($order->handled) {
                $orderReadyCount += 1;
            }
            if ($order->status == 'approved') {
                $productOrdersApprovedCount += 1;
                $productOrdersTotal += $order->quantity;
            } elseif ($order->status == 'charged') {
                $productOrdersChargedCount += 1;
            }
        }
        /**
         * Check if campaign has ended or all products have been sold.
         */
        if ($today < $product->end_date && $productOrdersTotal < 10) {
          $productActive = true;
        }

        if ($productOrdersChargedCount >= 1) {
            $productOrdersCharged = true;
        }

        if ($productOrdersChargedCount < $orderCount) {
            $hasOrders = true;
        }

        /**
         * Orders are ready for charge if orders have been handled and have not been charged
         */
        if ($orderReadyCount == $orderCount && $hasOrders) {
            $orderReady = true;
            if ($orderReady) {
                Session::flash('orders-ready', "All orders are approved. Click Charge to complete the deal");
            }
        }

        /**
         * Only calculated for orders not charged
         */

        if ($hasOrders) {
            /**
             * Price excl commission
             */
            $currentPct = currentPct($productOrdersTotal - 1);
            $product->priceExclCommission = price($product->price, $currentPct);
            $product->priceExclCommissionTotal = $product->priceExclCommission * $productOrdersTotal;

            /**
             * Commision
             */
            $product->commisionTotal = commission($product->price) * $productOrdersTotal;
        }

        // TODO Calculate for orders charged i.e. old orders

        return view('product.orders',
        compact('productOrders', 'product', 'orderReady', 'stripeLink', 'hasOrders', 'productActive', 'productOrdersCharged', 'productSalePriod', 'coPrice', 'coPriceTotal', 'commisionTotal', 'total'));
    }

    /**
     * Post method
     * Approve order Set handle orders and flash message.
     * @param Request $request
     * @return mixed
     */
    public function approveOrder(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $order->handled = 1;
        $order->save();

        $product = Product::where('id', $request->productId)->first();
        $product->online = 0;
        $product->save();

        Session::flash('order-approved', 'The order was approved');

        return Redirect::back();
    }

    /**
     * @param Request $request
     *
     * @return Redirect
     */
    public function finishOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect('notloggedin');
        }

        $productOrders = Order::where('product_id', $request->id)->where('status', 'approved')->where('handled', 1)->get();

        $product = Product::where('id', $request->id)->first();

        $productOrderSum = 0;
        foreach ($productOrders as $order) {
            $productOrderSum += $order->quantity;
        }

        $commission = commission($product->price);
        $currentPct = currentPct($productOrderSum - 1);
        $priceIncCommission = priceIncCommision($product->price, $currentPct);

        foreach ($productOrders as $order) {
            $order->price = $priceIncCommission;
            $order->total = $order->quantity * $priceIncCommission;
            $order->save();
        }

        $flashWarningMsg = [];
        $flashGoodMsg = [];

        \Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));

        foreach ($productOrders as $order) {

            $customer = \Stripe\Customer::retrieve($order->stripetoken);

            if ($customer && $customer->default_source) {
                $customerToken = \Stripe\Token::create(
                    ['customer' => $customer->id],
                    ['stripe_account' => $product->designer->user->stripe_code]
                );

                $techMsg = '';

                try {
                    $charge = \Stripe\Charge::create(
                        [
                            'amount' => intval(abs($order->total) * 100),
                            'currency' => 'dkk',
                            'source' => $customerToken->id,
                            'description' => $order->quantity.' x '.strtolower($product->title),
                            'receipt_email' => $order->email,
                            'application_fee' => intval($order->quantity * abs($commission) * 100),
                            'shipping' => [
                                'address'=> [
                                    'city' => $order->city,
                                    'country' => 'dk',
                                    'line1' => $order->address,
                                    'postal_code' => $order->postal
                                ],
                                'name' => $order->name
                            ],
                            'metadata' => [
                                'order_id' => $order->id,
                                'quantity' => $order->quantity,
                                'product' => $product->title,
                                'size' => $order->size,
                                'comment' => $order->comment
                            ]
                        ], ['stripe_account' => $product->designer->user->stripe_code]
                    );

//                    Log::info(__METHOD__ . ', line: ' . __LINE__ . ': charge obj: ' . var_export($charge,1));

                    if ($charge) {
                        $tOrder = Order::where('id', $order->id)->first();
                        $tOrder->status = 'charged';
                        $tOrder->price = ($order->total - $order->quantity * $commission) / $order->quantity;
                        $tOrder->save();

                        /**
                         * Send payment receipt email
                         */

                        Mail::to($order->email)->queue(new PaymentReceipt($order, $product));

                        $flashGoodMsg[] = $order->name.' – '.$order->email;
                    } else {
                        Session::flash('warning', 'A error occurred charging payment for order #'.$order->id.'. Please try again later.');
                        Log::warning("A warning occurred charging payment for order #' . $order->id . ' with product #".$product->id.'.');
                    }
                } catch (\Stripe\Error\Card $e) {
                    // Since it's a decline, \Stripe\Error\Card will be caught
                    $msg = 'The credit card of '.$order->name.' ('.$order->email.') was declined. Please try again later.'.PHP_EOL;
                    $techMsg = 'Exception caught: The CC of '.$order->name.' ('.$order->email.') was declined: '.PHP_EOL;

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    if (isset($err['decline_code'])) {
                        $techMsg .= 'Decline code:'.$err['decline_code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } catch (\Stripe\Error\RateLimit $e) {
                    // Too many requests made to the API too quickly
                    $msg = 'Too many requests made to the Stripe too quickly. Please try again later.'.PHP_EOL;
                    $techMsg = 'Exception caught: Too many requests made to the API too quickly: '.PHP_EOL;

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } catch (\Stripe\Error\InvalidRequest $e) {
                    // Invalid parameters were supplied to Stripe's API
                    $msg = 'Invalid parameters were supplied to Stripe. Please try again later.'.PHP_EOL;
                    $techMsg = 'Exception caught: Invalid parameters were supplied to Stripe\'s API: '.PHP_EOL;

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } catch (\Stripe\Error\Authentication $e) {
                    // Authentication with Stripe's API failed
                    // (maybe you changed API keys recently)
                    $msg = 'Authentication with Stripe failed. The System administrator was notified.'.PHP_EOL;
                    $techMsg = 'Exception caught: Authentication with Stripe\'s API failed. Maybe you changed API keys recently?: '.PHP_EOL;

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } catch (\Stripe\Error\ApiConnection $e) {
                    // Network communication with Stripe failed
                    $msg = 'Network communication with Stripe failed. The System administrator was notified about the problem.'.PHP_EOL;
                    $techMsg = 'Exception caught: Network communication with Stripe failed: '.PHP_EOL;

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } catch (\Stripe\Error\Base $e) {
                    // Display a very generic error to the designerUser, and maybe send yourself an email
                    $msg = 'A Stripe error occured. The System administrator was notified about the problem.'.PHP_EOL;
                    $techMsg = 'Exception caught: A very generic error with Stripe: '.PHP_EOL;

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } catch (Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    $msg = 'A error occurred charging payment for order #'.$order->id.'. It has nothing to do with the chargement. The System administrator was notified about the problem.'.PHP_EOL;
                    $techMsg .= 'An error occurred during CC charging. It had nothing to do with Stripe: ';

                    $body = $e->getJsonBody();
                    $err = $body['error'];

                    $techMsg .= 'Status is:'.$e->getHttpStatus().PHP_EOL;
                    $techMsg .= 'Type is:'.$err['type'].PHP_EOL;
                    if (isset($err['code'])) {
                        $techMsg .= 'Code is:'.$err['code'].PHP_EOL;
                    }
                    $techMsg .= 'Message is:'.$err['message'].PHP_EOL;
                    $techMsg .= 'Error data:'.var_export($err, 1).PHP_EOL;

                    $flashWarningMsg[] = $msg;
                } finally {

                    // If any of the exception above occured, let's prefix it with the order id and log it.
                    if (!empty($techMsg)) {
                        $techMsg = 'Exception with order '.$order->id.':'.PHP_EOL.$techMsg;

                        Log::error($techMsg);

                        // Notify System administrator
                        Notification::route('mail', config('constants.company_mail.system_admin'))
                                    ->notify(new StripeError($techMsg));
                    }
                }
            } else {
                Session::flash('warning', 'A error occurred charging payment for order '.$order->email.': a credit card was not found.');
                Log::warning('A warning occurred, trying to find a credit card for order '.$order->id.' with product #'.$product->id.'.');
            }
        }

        // If there are any messages to relay to either the designerUser or the admin, then apply them here.
        if (count($flashWarningMsg)) {
            Session::flash('warning', $flashWarningMsg);
        }

        // If there are any messages to relay to either the designerUser or the admin, then apply them here.
        if (count($flashGoodMsg)) {
            Session::flash('payment-success', $flashGoodMsg);
        }

        return Redirect::back();
    }
}
