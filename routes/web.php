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
Route::get('/', function () {
    return view('home');
    //return Member::all();
    /*
    $error = new MessageResult();
    $error->status = 0;
    $error->message = 'status test message';
    return $error->toJson();
    */
});

Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');
Route::get('/forgot_pw', 'View\MemberController@toForgot_pw');

/*services*/
Route::post('/service/register', 'Service\MemberController@register');
