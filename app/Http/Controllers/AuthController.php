<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReviewerTrait;
use App\Http\Controllers\Traits\ResearcherTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Notifications\VerifyEmailNotification;

class AuthController extends Controller
{
    // use ReviewerTrait, ResearcherTrait;

/*
*user type can be researcher/ reviewer
*/
    public function __construct()
    {
        $this->middleware('auth:api', ['only'=>['user']]);
        $this->middleware('email.verified', ['only'=>['user']]);
    }
    public function register()
    {
        //place traits in user model later .
        if(request()->user_type == 'reviewer'){
            return ReviewerTrait::registerReviewer();
        }
        if (request()->user_type == 'researcher') {
            return ResearcherTrait::registerResearcher();
        }
    }

    public function simpleRegistration()
    {
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'responseMessage'=> 'Validation Failed',
                'responseCode'=> '400',
                'data'=>$validator->errors()
                ]);
        }
        $user = User::create([
            'first_name'=>request()->first_name,
            'last_name'=> request()->last_name,
            'email'=> request()->email,
            'phone_number'=> request()->phone_number,
            'password'=> bcrypt(request()->password),
            'email_token'=> rand(100000, 999999),
            'type' => request()->type ?? 'researcher'
            ]);

        $user->notify(new VerifyEmailNotification($user));

        return response()->json([
            'responseMessage'=> 'Registration Successful. An email has been sent to the email provided. Kindly verify the account.',
            'responseCode'=>'201',
            'data'=>[]
            ]);
    }

    // Call this to get the currently authenticated user, you need to pass an access_token from passport.
    public function user()
    {
        return \Auth::user();
        return response()->json([
            'responseMessage' => 'Login Successful.',
            'responseCode' => '200',
            'data' => [request()->user()]
        ]);
    }
}
