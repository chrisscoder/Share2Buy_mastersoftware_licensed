<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AuthPagesController extends Controller
{
    /**
     * AuthPagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('pages.auth.profile');
    }
}
