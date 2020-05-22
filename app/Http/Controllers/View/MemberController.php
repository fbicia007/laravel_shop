<?php

namespace App\Http\Controllers\View;


use Illuminate\Routing\Controller as BaseController;

class MemberController extends BaseController
{

    public function toLogin($value='')
    {

        return view('login');

    }

    public function toRegister($value='')
    {

        return view('register');

    }
    public function toForgot_pw($value='')
    {

        return view('forgot_pw');

    }

}
