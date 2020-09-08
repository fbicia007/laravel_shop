<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use App\Entity\Member;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function index(){

        return view('admin.index');
    }

    public function toWelcome(){

        $admin = Member::find(1);
        return view('admin.welcome')->with('admin',$admin);
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
