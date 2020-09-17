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
/*
Route::get('/test', function () {
    return view('email_order');
});
*/

Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');
Route::get('/forgot_pw', 'View\MemberController@toForgot_pw');
Route::get('/change_pw', 'View\MemberController@toChange_pw');

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
    Route::get('change_email', 'Service\ValidateController@changeEmail');
    Route::post('change_password', 'Service\ValidateController@changePassword');
    Route::post('register', 'Service\MemberController@register');
    Route::post('edit_member', 'Service\MemberController@edit');
    Route::post('login', 'Service\MemberController@login');
    Route::post('logout', 'Service\MemberController@logout');
    Route::post('forgot_password', 'Service\MemberController@forgot_password');
    Route::get('products/{category_id}', 'Service\ProductsController@getCategoryByCategoryId');
    Route::get('products/{category_id}/platform/{platform_id}', 'Service\ProductsController@getCategoryByCategoryIdAndPlatfomId');
    Route::get('add/cart/{product_id}', 'Service\CartController@addCart');
    Route::get('dash/cart/{product_id}', 'Service\CartController@dashCart');
    Route::get('delete/cart', 'Service\CartController@deleteCart');
    Route::post('upload/{type}', 'Service\UploadController@uploadFile');

});


/*admin*/
Route::group(['prefix' => 'admin'], function (){

    Route::get('index', 'Admin\View\IndexController@index');
    Route::get('welcome', 'Admin\View\IndexController@toWelcome');

    Route::get('category', 'Admin\View\CategoryController@toCategory');
    Route::get('category_add', 'Admin\View\CategoryController@toCategoryAdd');
    Route::get('unCategory', 'Admin\View\CategoryController@toUnCategory');
    Route::get('unCategory_add', 'Admin\View\CategoryController@toUnCategoryAdd');
    Route::get('category_edit/{category_id}', 'Admin\View\CategoryController@toCategoryEdit');

    Route::get('product', 'Admin\View\ProductController@toProduct');
    Route::get('product_add', 'Admin\View\ProductController@toProductAdd');
    Route::get('product_edit/{product_id}', 'Admin\View\ProductController@toProductEdit');

    Route::get('member', 'Admin\View\MemberController@toMember');
    Route::get('member_add', 'Admin\View\MemberController@toMemberAdd');
    Route::get('member_edit/{member_id}', 'Admin\View\MemberController@toMemberEdit');
    Route::get('member_change_password/{member_id}', 'Admin\View\MemberController@toMemberChangePassword');

    Route::get('coupon', 'Admin\View\CouponController@toCoupon');

    Route::get('order', 'Admin\View\OrderController@toOrder');
    Route::get('order_details/{order_id}', 'Admin\View\OrderController@toOrderDetails');

    Route::get('bill', 'Admin\View\BillController@toBill');
    Route::get('log', 'Admin\View\IndexController@toLog');
    Route::get('setup', 'Admin\View\SetupController@toSetup');
    Route::get('login', 'Admin\View\IndexController@toLogin');

    Route::group(['prefix' => 'service'], function (){
        Route::post('login', 'Admin\Service\IndexController@login');

        Route::post('category/add', 'Admin\Service\CategoryController@categoryAdd');
        Route::post('category/del/{category_id}', 'Admin\Service\CategoryController@categoryDel');
        Route::post('category/edit/{category_id}', 'Admin\Service\CategoryController@categoryEdit');
        Route::post('category/change/status', 'Admin\Service\CategoryController@changeCategoryStatus');

        Route::post('product/add', 'Admin\Service\ProductController@productAdd');
        Route::post('product/del/{product_id}', 'Admin\Service\ProductController@productDel');
        Route::post('product/edit/{product_id}', 'Admin\Service\ProductController@productEdit');
        Route::post('product/change/status', 'Admin\Service\ProductController@changeProductStatus');

        Route::post('member/add', 'Admin\Service\MemberController@memberAdd');
        Route::post('member/del/{member_id}', 'Admin\Service\MemberController@memberDel');
        Route::post('member/edit/{member_id}', 'Admin\Service\MemberController@memberEdit');
        Route::post('member/change/status', 'Admin\Service\MemberController@changeMemberStatus');
        Route::post('member/change/password/{member_id}', 'Admin\Service\MemberController@changeMemberPassword');

        Route::post('order/shipped', 'Admin\Service\OrderController@changeOrderStatus');
        Route::post('order/del', 'Admin\Service\OrderController@delOrder');

    });

});
