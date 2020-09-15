<?php

namespace App\Http\Controllers\Admin\View;

use App\Entity\Member;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MemberController extends BaseController
{


    public function toMember(){

        $members = Member::all();

        return view('admin.member')->with('members',$members);
    }
    public function toMemberAdd(){

        return view('admin.member_add');
    }
    public function toMemberEdit(Request $request){

        $member_id = $request->member_id;
        $member = Member::find($member_id);

        return view('admin.member_edit')->with('member',$member);
    }
    public function toMemberChangePassword(Request $request){

        $member_id = $request->member_id;
        $member = Member::find($member_id);

        return view('admin.member_change_pw')->with('member',$member);
    }

    public function toAdmin(){

        $members = Member::where('super',1)->get();

        return view('admin.admin')->with('members',$members);
    }








}
