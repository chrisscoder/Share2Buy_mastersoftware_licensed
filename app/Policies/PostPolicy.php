<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return ($user->role == 'admin' || $user->role == 'designer');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return ($user->role == 'admin' || $user->role == 'designer');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return ($user->role == 'admin' || $user->role == 'designer');
    }
}
