<?php

namespace App\Http\Controllers\Admin\View;


use Illuminate\Routing\Controller as BaseController;

class BillController extends BaseController
{



    public function toBill(){

        return view('admin.bill');
    }




}
