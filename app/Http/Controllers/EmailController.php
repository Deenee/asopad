<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Notifications\VerifyEmailNotification;
use Log;

class EmailController extends Controller
{
    // ------
    //  Request from user's email address hits this and verifies the email.
    //
    public function verifyEmailWhenUserClicksVerificationButton()
    {
        $emailToken = request()->email_token;
        $user = User::where('email_token', $emailToken)->first();
        if (!$user) {
            Log::info('User not found', ['Email Token' => $emailToken]);
            return "Please try again";
        }

        $user->update(['email_token' => null, 'email_status' => 'verified']);
        return '<h1> Email Verified Successfully.</h1>';
        Log::info('Email Verified', ['User' => $user->email]);
    }

    /**
     * Resend a verification email to the user in case the previous one failed .
     * @param : email
     */
    public function resendVerificationEmail()
    {
        $user = User::where('email', request()->email)->first();
        if (!$user) {
            return response()->json([
                'responseMessage' => 'User not found.',
                'responseCode' => '44',
                'data' => []
            ]);
        }
        // If the user's email is already verified, dont send a verification email .
        if($user->email && $user->email_status == 'verified')
        {
            return response()->json([
                'responseMessage' => 'Email already verified. Please proceed.',
                'responseCode' => '412',
                'data' => []
            ]);
        }

        $user->update(['email_token' => str_random(60)]);
        try{
        $user->notify(new VerifyEmailNotification($user));
            return response()->json([
                'responseMessage' => 'Email sent to user.',
                'responseCode' => '200',
                'data' => []
            ]);
            }
            catch(\Throwable $e) {
                Log::debug('Email not sent.', ['Details'=> $e->getMessage()]);
                return response()->json([
                'responseMessage' => 'Email Not Sent.',
                'responseCode' => '45',
                'data' => []
        ]);
            }
        

    }

    public function response($code, $message, $data)
    {

    }

}
