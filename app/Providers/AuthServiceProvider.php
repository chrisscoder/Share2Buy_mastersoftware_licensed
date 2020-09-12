<?php

namespace App\Providers;

use App\Models\Designer;
use App\Models\DynamicPage;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Policies\DesignerPolicy;
use App\Policies\PagePolicy;
use App\Policies\PostPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Designer::class => DesignerPolicy::class,
        DynamicPage::class => PagePolicy::class,
        Post::class => PostPolicy::class,
        Product::class => ProductPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
