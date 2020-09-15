<?php

namespace App\Http\Controllers\Admin\Service;


use App\Entity\Member;
use App\Models\MessageResult;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;



class MemberController extends BaseController
{

    public function memberAdd(Request $request) {
        $email = $request->input('email', '');
        $lastName = $request->input('lastName', '');
        $firstName = $request->input('firstName', '');
        $street = $request->input('street', '');
        $city = $request->input('city', '');
        $state = $request->input('state', '');
        $zip = $request->input('zip', '');
        $phone = $request->input('phone', '');

        $member = new Member();
        $checkEmail = Member::where('email',$email)->get();
        if(!$checkEmail->isEmpty()){
            $m3_result = new MessageResult();
            $m3_result->status = 1;
            $m3_result->message = 'Email已存在!';

            return $m3_result->toJson();
        }

        $member->email = $email;

        $member->lastName = $lastName;
        $member->firstName = $firstName;
        $member->street = $street;
        $member->city = $city;
        $member->state = $state;
        $member->zip = $zip;
        $member->phone = $phone;
        $member->save();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function changeMemberStatus(Request $request){

        $member_id =$request->input('member_id','');

        if($member_id != ''){
            $member = Member::find($member_id);
            if($member->status == 0){
                $member->status = 1;
            }else{
                $member->status = 0;
            }
            $member->save();

            $m3_result = new MessageResult();
            $m3_result->status = 0;
            $m3_result->message = '修改成功';

            return $m3_result->toJson();
        }
    }
    public function memberDel(Request $request){

        $member_id = $request->member_id;

        Member::find($member_id)->delete();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '删除成功';

        return $m3_result->toJson();
    }
    public function changeMemberPassword(Request $request){

        $member_id = $request->member_id;
        $password = $request->input('password', '');
        $m3_result = new MessageResult();

        $member = Member::find($member_id);
        if($password != ''){
            if($password =='' || strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password)){
                $m3_result->status = 2;
                $m3_result->message = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                return $m3_result->toJson();
            }
            $member->password = md5('test' . $password);
            $member->save();
        } else {

            $m3_result->status = 1;
            $m3_result->message = '密码为空';
            return $m3_result->toJson();
        }

        $m3_result->status = 0;
        $m3_result->message = '密码修改成功';

        return $m3_result->toJson();
    }
    public function memberEdit(Request $request){

        $member_id = $request->member_id;

        $lastName = $request->input('lastName', '');
        $firstName = $request->input('firstName', '');
        $street = $request->input('street', '');
        $city = $request->input('city', '');
        $state = $request->input('state', '');
        $zip = $request->input('zip', '');
        $phone = $request->input('phone', '');

        $member = Member::find($member_id);

        $member->lastName = $lastName;
        $member->firstName = $firstName;
        $member->street = $street;
        $member->city = $city;
        $member->state = $state;
        $member->zip = $zip;
        $member->phone = $phone;
        $member->save();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '修改成功';

        return $m3_result->toJson();
    }

}
