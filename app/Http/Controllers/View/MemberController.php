<?php

namespace App\Http\Controllers\View;


use App\Entity\Category;
use Illuminate\Routing\Controller as BaseController;

class MemberController extends BaseController
{

    public function toLogin($value='')
    {

        $categorys = Category::whereNull('parent_id')->get();
        return view('login')->with('categorys', $categorys);

    }

    public function toRegister($value='')
    {

        $categorys = Category::whereNull('parent_id')->get();

        return view('register')->with('categorys', $categorys);;

    }
    public function toForgot_pw($value='')
    {

        $categorys = Category::whereNull('parent_id')->get();
        return view('forgot_pw')->with('categorys', $categorys);

    }

}
