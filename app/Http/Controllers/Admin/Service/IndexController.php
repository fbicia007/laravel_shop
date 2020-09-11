<?php

namespace App\Http\Controllers\Admin\Service;


use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function index(){

        return view('admin.index');
    }

}
