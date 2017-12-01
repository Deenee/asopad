<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterResearcher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register($type)
    {
       if ($type === 'researcher') {
           
       }
        return response()->json([
                'responseMessage' => 'Registration Successful.',
                'responseCode' => '200',
                'data'=> []
            ],200);
    }

    public function registerReviewer()
    {
        $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'field_of_research' => request()->field_of_research,
            // 'orcid' => request()->orcid,
            'institution' => request()->institution,
            'location_of_institution'=>request()->location_of_institution,
            'phone_number' => request()->phone_number
            ]);
    }

    public function registerResearcher(RegisterResearcher $request)
    {
        try{
         $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'field_of_research' => request()->field_of_research,
            'type' => 'researcher',
            // 'orcid' => request()->orcid,
            'institution' => request()->institution,
            'location_of_institution'=>request()->instLocation,
            ]);
        }catch(\Excption $e){
            Log::critical('Registration Error at registerResearcher!', ['Registration Data' => request()]);
            return response()->json([
                'responseMessage'=>'Registration failed.',
                'responseCode'=>'400',
                'data'=>[]
                ],200);
        }
         return response()->json([
                'responseMessage'=>'Registration Successful.',
                'responseCode'=>'200',
                'data'=>$user
                ],200);
    }
}
