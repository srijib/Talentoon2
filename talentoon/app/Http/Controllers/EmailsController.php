<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Response;

use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function receive_complaint(Request $request)
    {
        $user= JWTAuth::parseToken()->toUser();
        // dd($request->text);
        try {
            Mail::send('home',
               array(
                   'name' => $user->first_name,
                   'email' => 'talentoon88@gmail.com',
                   'subject' => 'complain or question',
                   'user_message' => $request->text
               ), function($message) use ($user)
               {
                   $message->from($user->email);
                   $message->to('talentoon88@gmail.com', 'Talentoon Admins')->subject('complain or question');
               });

        } catch (Exception $e) {
            return Response::json(['status' => '0','message' => 'sorry there is a problem in sending the email']);
        }

        return Response::json(['status' => '1','message' => 'your message sent successfully']);
    }
}
