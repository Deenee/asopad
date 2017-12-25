<?php

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\ValidateRequests\ValidateReviewerRequest;
use App\User;


trait ReviewerTrait{
	public static function registerReviewer()
	{
		$validator = new ValidateReviewerRequest;
		$validator = $validator->validate();
        if($validator && $validator->getData()->responseCode == '400'){
            return $validator;
        }
        $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'field_of_study' => request()->field_of_study,
            'type'=> 'reviewer',
            // 'orcid' => request()->orcid,
            'phone_number' => request()->phone_number,
            'institution_id' => request()->institution_id,
            'department_id'=>request()->department_id,
            ]);
        return response()->json(['responseMessage'=> 'Registration Successful.', 'responseCode'=> '201', 'data'=>[$user]
        	],200);
	}
}