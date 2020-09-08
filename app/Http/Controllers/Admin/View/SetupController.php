<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use App\Entity\EmailSetting;
use App\Entity\Product;
use App\Entity\ShopSetup;
use Illuminate\Routing\Controller as BaseController;

class SetupController extends BaseController
{


    public function toSetup(){

        $setup = ShopSetup::all()->first();
        $email_setting = EmailSetting::all()->first();

        return view('admin.setup')
            ->with('setup',$setup)
            ->with('email_setting',$email_setting);
    }








}
