<?php

use Illuminate\Support\Facades\Route;

//use App\Models\MessageResult;

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


Route::get('/','View\HomeController@toHome');


Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');
Route::get('/forgot_pw', 'View\MemberController@toForgot_pw');

Route::get('/category/{category_id}','View\HomeController@toCategory');
Route::get('/product/{product_id}','View\HomeController@toProduct');
Route::get('/cart','View\CartController@toCart');

Route::middleware('check.login')->group(function (){

    Route::get('/checkout', 'View\CheckoutController@checkout');
    Route::get('/overview', 'View\OverviewController@overview');
    Route::get('/order/success/{order_id}', 'View\CheckoutController@toOrderSuccess');
    Route::post('/pay', 'View\CheckoutController@afterPay');
});

/*services*/
Route::group(['prefix' => 'service'], function (){

    Route::get('validate_email', 'Service\ValidateController@validateEmail');
    Route::post('register', 'Service\MemberController@register');
    Route::post('login', 'Service\MemberController@login');
    Route::post('logout', 'Service\MemberController@logout');
    Route::get('products/{category_id}', 'Service\ProductsController@getCategoryByCategoryId');
    Route::get('products/{category_id}/platform/{platform_id}', 'Service\ProductsController@getCategoryByCategoryIdAndPlatfomId');
    Route::get('add/cart/{product_id}', 'Service\CartController@addCart');
    Route::get('dash/cart/{product_id}', 'Service\CartController@dashCart');
    Route::get('delete/cart', 'Service\CartController@deleteCart');

});


/*admin*/
Route::group(['prefix' => 'admin'], function (){

    Route::get('index', 'Admin\View\IndexController@index');
    Route::get('category', 'Admin\View\CategoryController@toCategory');
    Route::get('category_add', 'Admin\View\CategoryController@toCategoryAdd');
    Route::get('product', 'Admin\View\IndexController@toProduct');
    Route::get('news', 'Admin\View\IndexController@toNews');
    Route::get('member', 'Admin\View\IndexController@toMember');
    Route::get('admin', 'Admin\View\IndexController@toAdmin');
    Route::get('order', 'Admin\View\IndexController@toOrder');
    Route::get('bill', 'Admin\View\IndexController@toBill');
    Route::get('log', 'Admin\View\IndexController@toLog');
    Route::get('login', 'Admin\View\IndexController@toLogin');

    Route::group(['prefix' => 'service'], function (){
        Route::post('login', 'Admin\Service\IndexController@login');

    });

});
