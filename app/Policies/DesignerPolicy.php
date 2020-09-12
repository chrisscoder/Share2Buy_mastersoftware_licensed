<?php

namespace App\Policies;

use App\Models\Designer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DesignerPolicy
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
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->role == 'admin';
    }

    /**
     * @param User $user
     * @param Designer $designer
     * @return bool
     */
    public function update(User $user, Designer $designer)
    {
        return ($user->role == 'admin' || Auth::user()->designer->id == $designer->id);
    }
}
