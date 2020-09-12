<?php

namespace App\Providers;

use App\Models\DynamicPage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Loads dynamic pages for the footer
        View::composer('partials.footer', function ($view) {
            $footerLinks = DynamicPage::get();
            $footerLinksLeft = $footerLinks->where('menu_place', 'left');
            $footerLinksRight = $footerLinks->where('menu_place', 'right');

            $view->with('footerLinksLeft', $footerLinksLeft)
                ->with('footerLinksRight', $footerLinksRight);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
