<?php

namespace App\Http\Controllers\Service;


use App\Entity\TempEmail;
use App\Http\Controllers\Controller;

use App\Tool\UUID;
use Illuminate\Http\Request;
use App\Models\MessageResult;
use App\Entity\Member;
use Illuminate\Support\Facades\Mail;
use App\Models\MessageEmail;

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
         $state = $request->input('state','');
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

        $tempEmail = Member::where('email', $email)->first();

         if(isset($tempEmail->email)){
             $message_result->status = 6;
             $message_result->message = 'This email has been registiert!';
             return $message_result->toJson();
         } else {

             $member = new Member();
             $member->email = $email;
             $member->password = md5('test' . $password);
             $member->firstName = $firstName;
             $member->lastName = $lastName;
             $member->city = $city;
             $member->state = $state;
             $member->zip = $zip;
             $member->save();

             $uuid = UUID::create();

             $message_email = new MessageEmail();
             $message_email->to = $email;
             $message_email->subject = 'Please active your Email';
             $message_email->content = 'Dear '.$lastName.':<br/>Thank you to registiert MMOZONE Game Onlineshop <br/> Your username is "'
                                        .$email.'"<br/>Please click the Link to active your Account. The Link will in 24 Hours working'
                                        .'<br/>http://test.gamesgood.de/service/validate_email'
                                        .'?member_id='.$member->id
                                        .'&code='.$uuid;

             $tempEmail = new TempEmail();
             $tempEmail->member_id = $member->id;
             $tempEmail->uuid = $uuid;
             $tempEmail->deadline = date('Y-m-d H-i-s', time() + 24*60*60);
             $tempEmail->save();

             Mail::send(['html' => 'email_register'], ['message_email'=>$message_email], function ($m) use ($message_email){
                 $m->from('support@mmozone.de', 'MMOZONE online shop');

                 $m->to($message_email->to, 'dear user')
                     ->subject($message_email->subject);
             });

             $message_result->status = 0;
             $message_result->message = 'Register success!';
             return $message_result->toJson();

         }

    }
    public function login(Request $request)
    {
         $email = $request->input('email','');
         $password = $request->input('password','');


         $message_result = new MessageResult();

         if($email ==''){
             $message_result->status = 1;
             $message_result->message = 'Please input your email.';
             return $message_result->toJson();
         }
         if($password =='' || strlen($password) < 8){
             $message_result->status = 2;
             $message_result->message = 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.';
             return $message_result->toJson();
         }

         $member = Member::where('email', $email)->first();


         if(!isset($member->email)){

             $message_result->status = 3;
             $message_result->message = 'User is not found.!';
             return $message_result->toJson();

         } else {

             if($member->password != md5('test'.$password)) {

                 $message_result->status = 4;
                 $message_result->message = 'Your password is wrong, please try again.';
                 return $message_result->toJson();
             }
             else if($member->active == 0) {
                 $message_result->status = 5;
                 $message_result->message = 'You account is not active, please active you account.';
                 return $message_result->toJson();

             } else {

                 $request->session()->put('member', $member);

                 $message_result->status = 0;
                 $message_result->message = 'welcome dear '.$member->lastName;
                 return $message_result->toJson();

             }
         }




    }


}
