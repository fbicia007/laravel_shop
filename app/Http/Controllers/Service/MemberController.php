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
         $domain = $request->getHost();
         $email = $request->input('email','');
         $password = $request->input('password','');
         $confirm = $request->input('confirm','');
         $firstName = $request->input('firstName','');
         $lastName = $request->input('lastName','');
         $street = $request->input('street','');
         $phone = $request->input('phone','');
         $city = $request->input('city','');
         $state = $request->input('state','');
         $zip = $request->input('zip','');

         $message_result = new MessageResult();

         if($email ==''){
             $message_result->status = 1;
             $message_result->message = 'There are not Email';
             return $message_result->toJson();
         }
         if($password =='' || strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password)){
             $message_result->status = 2;
             $message_result->message = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
             return $message_result->toJson();
         }
         if($confirm =='' || strlen($password) < 8){
             $message_result->status = 3;
             $message_result->message = 'Confirmed password does not match the new password, please enter again';
             return $message_result->toJson();
         }
         /*
         if($firstName =='' || $lastName=='' || $phone=='' || $street == '' || $city=='' || $state == '' || $zip ==''){
             $message_result->status = 4;
             $message_result->message = 'Please give all infos.';
             return $message_result->toJson();
         }
         */
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
             $member->street = $street;
             $member->phone = $phone;
             $member->city = $city;
             $member->state = $state;
             $member->zip = $zip;
             $member->save();

             $uuid = UUID::create();

             $message_email = new MessageEmail();
             $message_email->to = $email;
             $message_email->subject = 'Please active your Email';
             $message_email->content = 'Dear '.$lastName.':<br/>Thank you to registiert MMOZONE Games Onlineshop <br/> Your username is "'
                                        .$email.'"<br/>Please click the Link to active your Account. The Link will in 24 Hours working'
                                        .'<br/>http://'.$domain.'/service/validate_email'
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
             $message_result->message = 'Register success! Please check you Email to active your account!';
             return $message_result->toJson();

         }

    }

    public function edit(Request $request)
    {
        $domain = $request->getHost();
        $count_type = $request->input('count_type','');
        $member_id = $request->input('member_id','');

        $member = Member::find($member_id);

        $firstName = $request->input('firstName','');
        $lastName = $request->input('lastName','');
        $phone = $request->input('new_phone','');
        $street = $request->input('street','');
        $city = $request->input('city','');
        $state = $request->input('state','');
        $zip = $request->input('zip','');
        $email = $request->input('email','');
        $current_password = $request->input('current_password','');
        $new_password = $request->input('new_password','');
        $confirm = $request->input('confirm','');



        $message_result = new MessageResult();

        switch ($count_type){

            case 'for_name':
                if($firstName =='' || $lastName==''){
                    $message_result->status = 4;
                    $message_result->message = 'Please give all infos.';
                    return $message_result->toJson();
                }
                $member->lastName = $lastName;
                $member->firstName = $firstName;
                $member->save();

                $message_result->status = 0;
                $message_result->message = 'You Name will be changed! ';
                return $message_result->toJson();

                break;
            case 'for_phone':
                if($phone==''){
                    $message_result->status = 4;
                    $message_result->message = 'Please give all infos.';
                    return $message_result->toJson();
                }
                $member->phone = $phone;
                $member->save();

                $message_result->status = 0;
                $message_result->message = 'Your phone number will be changed!';
                return $message_result->toJson();
                break;
            case 'for_address':
                if($street == '' || $city=='' || $state == '' || $zip ==''){
                    $message_result->status = 4;
                    $message_result->message = 'Please give all infos.';
                    return $message_result->toJson();
                }
                $member->street = $street;
                $member->zip = $zip;
                $member->state = $state;
                $member->city = $city;
                $member->save();

                $message_result->status = 0;
                $message_result->message = 'Your address will be changed!';
                return $message_result->toJson();
                break;
            case 'for_account':
                if($email ==''){
                    $message_result->status = 4;
                    $message_result->message = 'Please input your email.';
                    return $message_result->toJson();
                }

                $tempEmail = Member::where('email', $email)->first();

                if(isset($tempEmail->email)){
                    $message_result->status = 6;
                    $message_result->message = 'This email has been registiert!';
                    return $message_result->toJson();
                } else {

                    $member->change_email = $email;

                    $member->save();

                    $uuid = UUID::create();

                    $message_email = new MessageEmail();
                    $message_email->to = $email;
                    $message_email->subject = 'Please active your Email';
                    $message_email->content = 'Dear '.$member->lastName.':<br/>You change your email address, if not your, please ignor this email. <br/> Your new username is "'
                        .$email.'"<br/>Please click the Link to active your Account. The Link will in 24 Hours working'
                        .'<br/>http://'.$domain.'/service/change_email'
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
                    $message_result->message = 'Your account-ID (email address) will be changed,Please check you Email to active your action!';
                    return $message_result->toJson();

                }

                break;
            case 'for_password':
                $old_password = $member->password;

                if(md5('test' . $current_password)!=$old_password){
                    $message_result->status = 6;
                    $message_result->message = 'Your current password is wrong';
                    return $message_result->toJson();
                }
                if(strlen($new_password) < 8 || !preg_match('@[A-Z]@', $new_password) || !preg_match('@[a-z]@', $new_password) || !preg_match('@[0-9]@', $new_password) || !preg_match('@[^\w]@', $new_password)){
                    $message_result->status = 2;
                    $message_result->message = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                    return $message_result->toJson();
                }
                if($confirm =='' || strlen($new_password) < 8){
                    $message_result->status = 3;
                    $message_result->message = 'Confirmed password does not match the new password, please enter again';
                    return $message_result->toJson();
                }
                if($new_password != $confirm){
                    $message_result->status = 5;
                    $message_result->message = 'Confirmed password is wrong';
                    return $message_result->toJson();
                }
                $member->password = md5('test' . $new_password);
                $member->save();

                $message_result->status = 0;
                $message_result->message = 'Your password will be changed!';
                return $message_result->toJson();

                break;

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
             $message_result->message = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
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
                 $message_result->message = 'You account is not active, please use the Link in your Email to active you account.';
                 return $message_result->toJson();

             }
             else if($member->status == 0) {
                 $message_result->status = 6;
                 $message_result->message = 'You account is locked, please contact our service.';
                 return $message_result->toJson();

             } else {

                 $request->session()->put('member', $member);

                 $message_result->status = 0;
                 $message_result->message = 'welcome dear '.$member->lastName;
                 return $message_result->toJson();

             }
         }




    }

    public function logout(Request $request)
    {

        $request->session()->invalidate();
        $message_result = new MessageResult();

        $message_result->status = 0;
        $message_result->message = 'logout';
        return $message_result->toJson();

    }

    public function forgot_password(Request $request)
    {
        $email = $request->email;
        $message_result = new MessageResult();

        if($email ==''){
            $message_result->status = 1;
            $message_result->message = 'There are not Email';
            return $message_result->toJson();
        }
        $member = Member::where('email', $email)->first();

        if(!isset($member->email)){
            $message_result->status = 2;
            $message_result->message = 'This Email does not exist!';
            return $message_result->toJson();
        } else {

            $domain = $request->getHost();
            $uuid = UUID::create();

            $message_email = new MessageEmail();
            $message_email->to = $email;
            $message_email->subject = 'Reset your password';
            $message_email->content = 'Dear '.$member->lastName.':<br/>You can use this link reset your password. If noe you ask for it, please ignore this mail.<br/>'
                .'<br/>http://'.$domain.'/change_pw'
                .'?member_id='.$member->id
                .'&code='.$uuid;

            $tempEmail = TempEmail::where('member_id',$member->id)->first();
            if(isset($tempEmail)){
                $tempEmail->delete();
            }


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
            $message_result->message = 'An email with instructions to create a new password has been sent to '.$email.' if it is associated with an MMOZONE Games account. Your existing password has not been changed.';
            return $message_result->toJson();

        }
    }


}
