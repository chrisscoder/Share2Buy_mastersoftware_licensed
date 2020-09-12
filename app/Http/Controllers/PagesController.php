<?php

namespace App\Http\Controllers;

use DB;
use Route; // delete
use Stripe;
use Redirect;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Designer;
use App\Mail\OrderConfirmation;
use App\Notifications\ProductOrdered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;


class PagesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function notloggedin()
    {
        return view('pages.notloggedin');
    }

    /**
     * Add to basket is used on the frontend in relation to checkout
     * @param Request $request [description]
     * @return array
     */
    public function addToBasket(Request $request)
    {
        Session::put('product_id', $request->product_id);
        Session::put('price', $request->price);
        Session::put('quantity',   $request->quantity);
        if ($request->size) {
          Session::put('size',   $request->size);
        } else {
          Session::forget('size');
        }

        return ['success' => 1];
    }

    /**
     * Checkout post method
     * @param  Request $request [description]
     * @return RedirectResponse
     */
    public function checkoutOrderReserve(Request $request)
    {
        $product = Product::where('id', Session::get('product_id'))->first();
        $productOrders = Order::where('product_id', $product->id)->where('handled', 0)->where('status', '!=', 'charged')->get();
        $product->load('designer');

        $productOrderSum = 0;
        foreach ($productOrders as $order) {
            $productOrderSum += $order->quantity;
        }

        // If more than 10 orders, redirect back
        // TODO this should be a variable set per campaign by the designer
        if (($productOrderSum + Session::get('quantity')) > 10) {
            return redirect('checkout/error');
        }

        $order = new Order();
        $order->product_id = Session::get('product_id');
        $order->quantity = Session::get('quantity');
        $order->total = Session::get('orderTotal');
        $order->price = Session::get('orderPrice');

        if (Session::has('size')) {
            $order->size = Session::get('size');
        } else {
            $sizes = explode(';', $product->type_value);
            $order->size = $sizes[0];
        }

        $order->name = $request->name;
        $order->address = $request->address;
        $order->postal = $request->postal;
        $order->city = $request->city;
        $order->email = $request->email;
        $order->comment = $request->comment;

        $stripe = new Stripe();

        $customer = $stripe::customers()->create([
         'email' => $order->email,
         'metadata' => [
             'name' => $order->name,
             'address' => $order->address,
             'postal' => $order->postal,
             'city' => $order->city,
             'quantity' => Session::get('quantity'),
             'product' => $product->title,
         ],
       ]);

        $card = $stripe::cards()->create($customer['id'], $request->stripeToken);
        $order->stripeToken = $customer['id'];
        $order->status = 'approved';
        $order->save();

        /**
         * Send email checkout order and redirect to checkout success
         */

        Mail::to($order->email)->queue(new OrderConfirmation($order, $product));

        User::find($product->designer->user_id)->notify(new ProductOrdered($product, $order));


        Session::put('product_id', $product->id);

        return redirect('checkout/success');
    }

    /**
     * Checkout success
     * @return view
     */
    public function checkoutSuccess()
    {
        $product = Product::has('designer')->where('id', Session::get('product_id'))->first();

        $productOrders = Order::where('product_id', $product->id)->where('handled', 0)->where('status', '!=', 'charged')->get();

        $product->currentPct = currentPct($product->order_count);
        $product->priceIncCommission = priceIncCommision($product->price, $product->currentPct);
        $product->discount = discount($product->price, $product->priceIncCommission);

        // get top 4 popular products from active products
        $now = Carbon::now();

        $products = Product::has('designer')->where([
          ['online', 1],
          ['start_date','<',$now],
          ['end_date','>',$now]
          ])->get();

        $popularProducts = $this->getBestSelling(4);

        return view('pages.checkout_success', compact('product', 'popularProducts'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function checkoutError()
    {
        return view('pages.checkout_error');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getBestSelling($take = 8)
    {
        $best_selling = Order::whereHas('product', function ($query) {
            $now = Carbon::now();
            $query->where([
              ['end_date', '>', $now],
              ['price', '>', 0],
            ]);
        })->has('product.designer')
            ->with('product', 'product.ordersUnhandled', 'product.designer')
            ->select(DB::raw('product_id, sum(`orders`.`quantity`) AS `quantity`'))
            ->groupBy('product_id')
            ->orderBy('quantity', 'desc')
            ->take($take*2)->get();

        $products = collect();
        foreach ($best_selling as $order) {
            $products[] = $order->product;
        }

        foreach ($products as $key => &$product) {
            $productOrders = 0;
            if (!empty($product->ordersUnhandled)) {
              foreach ($product->ordersUnhandled as $order) {
                  $productOrders += $order->quantity;
              }

              if ($productOrders == 10) {
                 $products->forget($key);
              }
            }
        }

        return $products->take($take);
    }
}
