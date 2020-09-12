<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $user->role == 'admin';
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role == 'admin';
    }

    /**
     * @param User $user
     * @param User $affectedUser
     * @return bool
     */
    public function delete(User $user, User $affectedUser)
    {
        return ($user->role == 'admin' || (Auth::id() == $affectedUser->id && !$affectedUser->designer->has_orders_not_handled));
    }

    /**
     * @param User $user
     * @param User $affectedUser
     * @return bool
     */
    public function update(User $user, User $affectedUser)
    {
        return ($user->role == 'admin' || Auth::id() == $affectedUser->id);
    }
}
