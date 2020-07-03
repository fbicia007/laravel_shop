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
use App\Entity\Member;

Route::get('/','View\HomeController@toHome');


Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');
Route::get('/forgot_pw', 'View\MemberController@toForgot_pw');

Route::get('/category/{category_id}','View\HomeController@toCategory');



/*services*/
Route::group(['prefix' => 'service'], function (){

    Route::get('validate_email', 'Service\ValidateController@validateEmail');
    Route::post('register', 'Service\MemberController@register');
    Route::post('login', 'Service\MemberController@login');
    Route::get('products/{category_id}', 'Service\ProductsController@getCategoryByCategoryId');
    Route::get('products/{category_id}/platform/{platform_id}', 'Service\ProductsController@getCategoryByCategoryIdAndPlatfomId');

});
