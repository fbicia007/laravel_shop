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

}
