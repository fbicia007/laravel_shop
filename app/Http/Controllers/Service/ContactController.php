<?php

namespace App\Http\Controllers\Service;


use App\Entity\Contact;
use App\Models\MessageResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContactController extends Controller
{

    public function contactRequest(Request $request)
    {
        $email = $request->input('email','');
        $type = $request->input('problem_type','');
        $subject = $request->input('subject','');
        $description = $request->input('description','');

        $m3_result = new MessageResult();


        if ($email != '' && $type != '' && $subject!='' && $description!='') {

            $contact = new Contact();
            $contact->email = $email;
            $contact->type = $type;
            $contact->subject = $subject;
            $contact->description = $description;
            $contact->save();

            $m3_result->status = 0;
            $m3_result->message = "Your request already send, we will contact in 24h!";

        } else {

            $m3_result->status = 1;
            $m3_result->message = "Error!";

        }

        return $m3_result->toJson();
    }

}
