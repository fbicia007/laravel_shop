<?php

namespace App\Http\Controllers\Admin\View;

use App\Entity\Member;
use Illuminate\Routing\Controller as BaseController;

class MemberController extends BaseController
{


    public function toMember(){

        $members = Member::all();

        return view('admin.member')->with('members',$members);
    }
    public function toAdmin(){

        $members = Member::where('super',1)->get();

        return view('admin.admin')->with('members',$members);
    }








}
