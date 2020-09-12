<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class CheckoutController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function checkout()
    {

        if (Session::has('product_id') && Session::has('quantity')) {
            $id = Session::get('product_id');
            $quantity = Session::get('quantity');

            $product = Product::with('designer', 'orders')->find($id);

            $currentPct = $product->currentPct($quantity);
            $priceIncCommission = priceIncCommision($product->price, $currentPct);
            $priceTotal = $priceIncCommission * $quantity;
            $discount = discount($product->price, $priceIncCommission) * $quantity;

            $stripePrice = str_replace(',', '', $priceTotal);
            $stripePublicKey = Config::get('services.stripe.key');

            if (Session::has('size')) {
                $size = Session::get('size');
            } else {
                $sizes = explode(';', $product->type_value);
                $size = $sizes[0];
            }

            Session::put(['orderPrice' => $priceIncCommission, 'orderTotal' => $priceTotal]);
        } else {
            return redirect()->back();
        }



        return view('pages.checkout', compact('currentPct', 'discount', 'product', 'priceIncCommission', 'priceTotal', 'size' , 'stripePrice', 'stripePublicKey'));
    }
}
