<?php

namespace App\Http\Controllers\Traits;
use App\Http\Controllers\ValidateRequests\ValidateResearcherRequest;
use App\User;
use Log;

trait ResearcherTrait{
	public static function registerResearcher()
	{
		Log::info('Register researcher');

		$validator = new ValidateResearcherRequest;
		$validator = $validator->validate();
        if($validator && $validator->getData()->responseCode == '400'){
            return $validator;
        }
		try{
         $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'phone_number'=> request()->phone_number,
            'password' => bcrypt(request()->password),
            'field_of_research' => request()->field_of_research,//optional //helps match reserchers to reviewers.
            'type' => 'researcher',
            // 'orcid' => request()->orcid,
            ]);
        }catch(\Excetion $e){
            Log::critical('Error registering researcher!', ['Error'=> $e->getMessage(),'Request' => request()]);
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