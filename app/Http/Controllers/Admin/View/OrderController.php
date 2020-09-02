<?php

namespace App\Http\Controllers\Admin\View;


use Illuminate\Routing\Controller as BaseController;

class OrderController extends BaseController
{


    public function toOrder(){

        return view('admin.order');
    }





}
