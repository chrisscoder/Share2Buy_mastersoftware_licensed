<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/*
 * Home
 */
Route::get('/', 'PageController@frontpage')->name('frontpage');


/*
 * Static pages
 */
Route::get('/markets/2017/forarsmessen', 'PagesController@forarsmessen2017');

/*
 * Auth
 */
Auth::routes();
Route::get('/notloggedin', 'PagesController@notloggedin');


/*
 * Checkout
 * REFACTOR checkout should have their own controller
 */
Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
Route::post('/checkout/order/create', 'PagesController@checkoutOrderReserve');
Route::get('/checkout/success', 'PagesController@checkoutSuccess');
Route::get('/checkout/error', 'PagesController@checkoutError');
Route::post('/addToBasket', 'PagesController@addToBasket'); // used in angular

/*
 * Dashboard
 * TODO move to auth middleware group. Need to change route everywere
 */
// Route::get('/dashboard', function () {
//  return redirect('admin/dashboard');
// });
Route::get('/dashboard/stripe', 'DashboardController@stripeattach');
Route::get('/dashboard/stripe/remove', 'DashboardController@stripedetach');

/*
 * Products
 */
Route::get('products', 'ProductController@index')->name('products');
Route::get('products/{product}', 'ProductController@show')->name('products.show');

/*
 * Orders
 * TODO Should have their own controller and follow REST best practice
 */
Route::get('/products/orders/{id}', 'ProductController@orders');
Route::post('/products/orders/approveOrder', 'ProductController@approveOrder');
Route::post('/products/orders/finishOrder', 'ProductController@finishOrder');

/*
 * Designers
 */
Route::get('/brands', 'DesignerController@index')->name('designers');
Route::get('/brands/{designer}', 'DesignerController@show')->name('designers.show');

/*
 * Blog posts
 */
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/tagged/{tag}', 'BlogController@tagged')->name('blog.tagged');
Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');


/*
 * Images
 */
Route::get('pics/{type}/{size}/{file}', 'ImageController@image');

/*
 * JSON
 */
Route::get('/json/products', 'ProductController@jsonProducts');

/*
|--------------------------------------------------------------------------
| Admin area
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Feature Products
    |--------------------------------------------------------------------------
    */

    Route::put('featured/product','FeaturedController@update')->name('featured.product');

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index')->name('admin.products');
        Route::get('add','ProductController@add')->name('products.add');
        Route::post('add', 'ProductController@store')->name('products.store');
        Route::get('{product}/delete', 'ProductController@delete')->name('products.delete');
        Route::get('{product}/edit', 'ProductController@edit')->name('products.edit');
        Route::post('{product}/edit', 'ProductController@update')->name('products.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Designers
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'designers'], function () {
        Route::get('/', 'DesignerController@index')->name('admin.designers');
        Route::get('add', 'DesignerController@add')->name('designers.add');
        Route::post('add', 'DesignerController@store')->name('designers.store');
        Route::put('featured', 'DesignerController@featured')->name('designers.featured');
        Route::get('{designer}/edit', 'DesignerController@edit')->name('designers.edit');
        Route::post('{designer}/edit', 'DesignerController@update')->name('designers.update');
        Route::get('{designer}/delete', 'DesignerController@delete')->name('designers.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', 'PageController@index')->name('admin.pages');
        Route::get('create', 'PageController@create')->name('admin.pages.create');
        Route::post('create', 'PageController@store')->name('admin.pages.store');
        Route::get('{page}/edit', 'PageController@edit')->name('admin.pages.edit');
        Route::put('{page}/edit', 'PageController@update')->name('admin.pages.update');
        Route::get('{page}/delete', 'PageController@delete')->name('admin.pages.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'users'], function () {
        Route::get('{user}/edit', 'UserController@edit')->name('admin.users.edit');
        Route::put('{user}/edit', 'UserController@update')->name('admin.users.update');
        Route::get('{user}/delete', 'UserController@delete')->name('admin.users.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Blog posts
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', 'BlogController@index')->name('admin.blog');
        Route::get('create', 'BlogController@create')->name('admin.blog.create');
        Route::post('create', 'BlogController@store')->name('admin.blog.store');
        Route::get('{post}/edit', 'BlogController@edit')->name('admin.blog.edit');
        Route::put('{post}/edit', 'BlogController@update')->name('admin.blog.update');
        Route::get('{post}/delete', 'BlogController@delete')->name('admin.blog.delete');
    });
});

/*
 * Dymamic pages
 */
Route::get('/{page}', 'PageController@page')->name('page');
