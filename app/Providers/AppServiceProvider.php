<?php

namespace App\Providers;

use App\Models\Designer;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\App::environment('local')) {
           \URL::forceScheme('https');
        }

        Relation::morphMap([
            'designer' => Designer::class,
            'post' => Post::class,
            'product' => Product::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
