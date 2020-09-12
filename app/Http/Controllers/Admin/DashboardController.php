<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designer;
use App\Models\DynamicPage;
use App\Models\FeaturedProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Log;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        if (!defined('TOKEN_URI')) {
            define('TOKEN_URI', 'https://connect.stripe.com/oauth/token');
        }

        if (!defined('AUTHORIZE_URI')) {
            define('AUTHORIZE_URI', 'https://connect.stripe.com/oauth/authorize');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|void
     */
    public function index(Request $request)
    {
        if ($request->user()->role == 'admin') {
            return $this->adminDashboard($request);
        }

        return $this->designerDashboard($request);
    }

    /**
     * @return \Illuminate\View\View
     */
    private function adminDashboard(Request $request)
    {
        $now = Carbon::now();
        $designers_all = Designer::latest()->get();
        $designers = $designers_all->take(5);
        $products = Product::with('designer', 'orders')
            ->has('designer')
            ->latest()
            ->take(5)
            ->get();
        $orders = Order::latest()->take(5)->get();
        $pages = DynamicPage::get();
        $products_featured = FeaturedProduct::active()->buyable()
            ->with('product')
            ->orderBy('priority')
            ->get();
        // Used in featured product select
        $products_all = Product::buyable()
            ->where([
              ['end_date', '>', $now],
              ['price', '>', 0],
            ])
            ->orderBy('title')
            ->get();
        $site_settings = DB::select('SELECT * FROM site_settings');

        return view('admin.dashboard.admin', compact('admins', 'designers', 'designers_all', 'orders', 'pages', 'products', 'products_all', 'products_featured', 'site_settings'));
    }

    /**
     * @return \Illuminate\View\View
     */
    private function designerDashboard(Request $request)
    {
        $stripeLink = $this->getStripeLink($request);
        Session::put('stripe_link', $stripeLink);

        $products = Product::whereHas('designer', function ($query) {
            $query->where('id', Auth::user()->designer->id);
        })->with('designer', 'orders')->withCount('ordersUnhandled')
            ->sortable()
            ->get();

        return view('admin.dashboard.designer', compact('orders', 'products', 'stripeLink'));
    }


    /**
     * Generate stripe link. Consider using Laravel Passport
     * https://stripe.com/docs/connect/sample-oauth-apps
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    private function getStripeLink(Request $request)
    {
        if (isset($_GET['code'])) { // Redirect w/ code
            $code = $_GET['code'];
            $token_request_body = [
                'client_secret' => Config::get('services.stripe.secret'),
                'grant_type' => 'authorization_code',
                'client_id' => Config::get('services.stripe.id'),
                'code' => $code,
            ];

            if (\App::environment('local')) {
                $authorize_request_body['redirect_uri'] = url('/dashboard/stripe');
            } elseif (\App::environment('staging')) {
                $authorize_request_body['redirect_uri'] = secure_url('/dashboard/stripe');
            }

            $req = curl_init(TOKEN_URI);
            curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($req, CURLOPT_POST, true);
            curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));

            $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
            if ($respCode === 0) {
                $resp = json_decode(curl_exec($req), true);
//                Log::info(__METHOD__ . ': Access token: ' . $resp['access_token']);
            }

            curl_close($req);

            // echo $resp['access_token'];
        } elseif (isset($_GET['error'])) { // Error
            echo $_GET['error_description'];
            Log::warning(__METHOD__.': Warning from Stripe: '.$_GET['error_description']);
        } else { // Show OAuth link
            $authorize_request_body = [
                'response_type' => 'code',
                'client_id' => Config::get('services.stripe.id'),
                'scope' => 'read_write',
            ];

            if (\App::environment('local')) {
                $authorize_request_body['redirect_uri'] = url('/dashboard/stripe');
            } elseif (\App::environment('staging')) {
                $authorize_request_body['redirect_uri'] = secure_url('/dashboard/stripe');
            }

            $url = AUTHORIZE_URI.'?'.http_build_query($authorize_request_body);

            return $url;
        }
    }
}
