<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProductPolicy
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
    public function delete(User $user, Product $product)
    {
        return ($user->role == 'admin' || Auth::user()->designer->id == $product->designer_id);
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function update(User $user, Product $product)
    {
        return ($user->role == 'admin' || Auth::user()->designer->id == $product->designer_id);
    }
}
