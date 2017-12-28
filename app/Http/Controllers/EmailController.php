<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Notifications\VerifyEmailNotification;

class EmailController extends Controller
{
    public function verifyEmail()
    {
        $user = User::where('email', request()->email)->first();
        if (!$user) {
            return response()->json([
                'responseMessage' => 'User not found.',
                'responseCode' => '44',
                'data' => []
            ]);
        }

        if (request()->email_token !== $user->email_token) {
            return response()->json([
                'responseMessage' => 'Codes do not match',
                'responseCode' => '45',
                'data' => []
            ]);
        }

        $user->update(['email_token' => null, 'email_status' => 'verified']);

        return response()->json([
            'responseMessage' => 'Email verified. Please Continue.',
            'responseCode' => '200',
            'data' => []
        ]);
    }

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

        $user->update(['email_token' => rand(100000, 999999)]);
        $user->notify(new VerifyEmailNotification($user));
        return response()->json([
            'responseMessage' => 'Email sent to user.',
            'responseCode' => '200',
            'data' => []
        ]);
    }

}
