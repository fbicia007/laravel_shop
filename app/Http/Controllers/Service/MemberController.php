<?php

namespace App\Http\Controllers\Service;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MessageResult;

class MemberController extends Controller
{

    public function register(Request $request)
    {
         $email = $request->input('email','');
         $password = $request->input('password','');
         $confirm = $request->input('confirm','');
         $firstName = $request->input('firstName','');
         $lastName = $request->input('lastName','');
         $city = $request->input('city','');
         $state = $request->input('states','');
         $zip = $request->input('zip','');

         $message_result = new MessageResult();

         if($email ==''){
             $message_result->status = 1;
             $message_result->message = 'There are not Email';
             return $message_result->toJson();
         }
         if($password =='' || strlen($password) < 8){
             $message_result->status = 2;
             $message_result->message = 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.';
             return $message_result->toJson();
         }
         if($confirm =='' || strlen($password) < 8){
             $message_result->status = 3;
             $message_result->message = 'Confirmed password does not match the new password, please enter again';
             return $message_result->toJson();
         }
         if($firstName =='' || $lastName=='' || $city=='' || $state == '' || $zip ==''){
             $message_result->status = 4;
             $message_result->message = 'Please give all infos.';
             return $message_result->toJson();
         }
         if($password != $confirm){
             $message_result->status = 5;
             $message_result->message = 'Confirmed password is wrong';
             return $message_result->toJson();
         }

    }


}
