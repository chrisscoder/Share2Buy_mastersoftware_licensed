<?php

namespace App\Policies;

use App\Models\DynamicPage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

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
     * @param DynamicPage $page
     * @return bool
     */
    public function update(User $user, DynamicPage $page)
    {
        return $user->role == 'admin';
    }
}
