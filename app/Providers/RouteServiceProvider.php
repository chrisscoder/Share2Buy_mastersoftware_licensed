<?php

namespace App\Providers;

use App\Models\Designer;
use App\Models\DynamicPage;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('designer', function ($value) {
            return Designer::where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });

        Route::bind('page', function ($value) {
            if (view()->exists('pages.'.$value)) {
                return $value;
            }
            return DynamicPage::where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });

        Route::bind('post', function ($value) {
            return Post::where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });

        Route::bind('product', function ($value) {
            return Product::where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });

        Route::bind('tag', function ($value) {
            return Tag::where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });
    }

    // /**
    //  * Define the routes for the application.
    //  *
    //  * @param  \Illuminate\Routing\Router  $router
    //  * @return void
    //  */
    // public function map(Router $router)
    // {
    //     $router->group(['namespace' => $this->namespace], function ($router) {
    //         require app_path('Http/routes.php');
    //     });
    // }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
           ->middleware('api')
           ->namespace($this->namespace)
           ->group(base_path('routes/api.php'));
    }

}
