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

    Route::get('/checkout/{product_ids}', 'View\CheckoutController@checkout');
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
