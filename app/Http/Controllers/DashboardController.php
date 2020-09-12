<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DynamicPage;
use App\Models\Designer;
use App\Models\Product;
use App\Models\Order;
use Log;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');

        if (!defined('TOKEN_URI')) {
            define('TOKEN_URI', 'https://connect.stripe.com/oauth/token');
        }

        if (!defined('AUTHORIZE_URI')) {
            define('AUTHORIZE_URI', 'https://connect.stripe.com/oauth/authorize');
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function stripeattach(Request $request)
    {
        $user = Auth::user();
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
//            Log::info(__METHOD__ . ': Access token: ' . $resp['access_token']);
        }
        curl_close($req);

        $user->stripe_code = $resp['stripe_user_id'];
        $user->save();

        Session::flash('message', 'Your Stripe account has now been connected');

        return redirect('admin/dashboard');
    }

    public function stripedetach()
    {
        $user = Auth::user();
        $user->stripe_code = '';
        $user->save();

        Session::flash('message', 'Your Stripe account has now been disconnected');

        return redirect('admin/dashboard');
    }

}
