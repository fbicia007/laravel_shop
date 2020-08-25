<?php
/**
 * Created by PhpStorm.
 * User: fbicia
 * Date: 2020-05-22
 * Time: 22:48
 */

namespace App\Http\Controllers\Service;

use App\Entity\Member;
use App\Entity\TempEmail;
use App\Http\Controllers\Controller;
use App\Models\MessageResult;
use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function validateEmail(Request $request)
    {
        $member_id = $request->input('member_id','');
        $uuid = $request->input('code','');
        if($member_id == null){
            return 'validate error!';
        }

        $tempEmail = TempEmail::where('member_id', $member_id)->first();

        if($tempEmail == null){
            return 'validate error!';
        }

        if($tempEmail->uuid == $uuid){

            if(time() > strtotime($tempEmail->deadline)){
                return 'Link is timeout!';
            }

            $tempEmail->delete();

            $member = Member::find($member_id);
            $member->active = 1;
            $member->save();

            return redirect('/login');

        } else {
            return 'Link is timeout!';
        }

    }

    public function changeEmail(Request $request)
    {
        $member_id = $request->input('member_id','');

        $uuid = $request->input('code','');
        if($member_id == null){
            return 'validate error!';
        }

        $tempEmail = TempEmail::where('member_id', $member_id)->first();

        if($tempEmail == null){
            return 'validate error!';
        }

        if($tempEmail->uuid == $uuid){

            if(time() > strtotime($tempEmail->deadline)){
                return 'Link is timeout!';
            }

            $tempEmail->delete();

            $member = Member::find($member_id);
            $member->email = $member->change_email;
            $member->save();

            return redirect('/login');

        } else {
            return 'Link is timeout!';
        }

    }

    public function changePassword(Request $request)
    {
        $member_id = $request->input('member_id','');
        $password = md5('test' . $request->input('password',''));

        $uuid = $request->input('code','');
        $message_result = new MessageResult();

        if($member_id == null){
            $message_result->status = 1;
            $message_result->message = 'validate error!';
            return $message_result->toJson();
        }

        $tempEmail = TempEmail::where('member_id', $member_id)->first();

        if($tempEmail == null){
            $message_result->status = 2;
            $message_result->message = 'validate error!';
            return $message_result->toJson();
        }

        if($tempEmail->uuid == $uuid){

            if(time() > strtotime($tempEmail->deadline)){
                $message_result->status = 3;
                $message_result->message = 'Link is timeout!';
                return $message_result->toJson();
            }

            $tempEmail->delete();

            $member = Member::find($member_id);
            $member->password = $password;
            $member->save();

            $message_result->status = 0;
            $message_result->message = 'reset password success!';
            return $message_result->toJson();

        } else {
            $message_result->status = 4;
            $message_result->message = 'validate error!';
            return $message_result->toJson();
        }

    }

}
