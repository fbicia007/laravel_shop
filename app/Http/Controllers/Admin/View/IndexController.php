<?php

namespace App\Http\Controllers\Admin\View;


use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function index(){

        return view('admin.index');
    }
    public function toCategory(){

        return view('admin.category');
    }
    public function toProduct(){

        return view('admin.product');
    }
    public function toNews(){

        return view('admin.news');
    }
    public function toMember(){

        return view('admin.member');
    }
    public function toAdmin(){

        return view('admin.admin');
    }
    public function toOrder(){

        return view('admin.order');
    }
    public function toBill(){

        return view('admin.bill');
    }
    public function toLog(){

        return view('admin.log');
    }

    public function toLogin(){

        return view('admin.login');
    }
    public function login(){

        return redirect('admin.index');
    }




}
