<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

    /**
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        if (empty($request->password)) {
            $user->update($request->except('password'));
        } else {
            $user->update($request->all());
        }

        flash_message('User updated');

        if ($request->user()->role != 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('admin.users');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user)
    {
        $this->authorize('delete', $user);

        if (!is_null($user->designer)) {
            $user->designer->products()->delete();
            $user->designer()->delete();
        }

        $user->delete();

        if (Auth::id() == $user->id) {
            Auth::logout();
            Session::flush();
            Session::regenerate();
            return redirect('/');
        }

        return redirect()->route('frontpage');
    }

}
