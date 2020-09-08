<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Coupon;
use Illuminate\Routing\Controller as BaseController;

class CouponController extends BaseController
{

    public function toCoupon(){

        $coupons = Coupon::all();
        return view('admin.coupon')->with('coupons',$coupons);
    }




}
