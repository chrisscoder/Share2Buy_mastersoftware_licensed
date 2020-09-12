<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Designer;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class DesignerController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $designers = Designer::orderBy('created_at', 'desc')->get();

        return view('designer.index', compact('designers'));
    }

    /**
     * @param Designer $designer
     * @return \Illuminate\View\View
     */
    public function show(Designer $designer)
    {
        $designer->load(['products', 'products.orders']);

        return view('designer.show', compact('designer'));
    }

    /**
     * TODO refactor designer user when adding registration of users
     * @param $id
     * @return \Illuminate\View\View|Redirect
     */
    function user($id) {

      if(!Auth::check()) {
        return redirect('notloggedin');
      }

      if((Auth::user()->role!='admin'&&Auth::user()->designer->id!=$id)) {
        abort(403);
      }

      $user = User::where('designer_id', $id)->first();

      return view('designer.user',compact('user'));
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    function update_user(Request $request) {

        $user = User::where('id',$request->user_id)->first();
        $user->email = $request->email;
        $user->name = $request->name;

        if(!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        Session::flash('message', "Opdateret");
        return redirect('dashboard');

    }
}
