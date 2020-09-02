<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function index(){

        return view('admin.index');
    }

    public function toNews(){

        return view('admin.news');
    }
    public function toAdmin(){

        return view('admin.admin');
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
