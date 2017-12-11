<?php 

namespace App\Http\Controllers\ValidateRequests;

use Illuminate\Http\Request;
use Validator;

/**
* Validate researcher
*/
class ValidateResearcherRequest
{
	protected $rules = [
			'first_name' => 'required',
            'last_name' => 'required',
            'email' =>'required|unique:users|email',
            'password'  => 'required|confirmed',
            'password_confirmation' => 'required',
            'phone_number'=> 'required|unique:users|phone_number'
           ];

	public function validate()
	{
		$validator = Validator::make(request()->all(), $this->rules);
		if ($validator->fails()) {
			return response()->json([
				'responseMessage' => 'Validation failed.' ,
				'responseCode' => '400',
				'data'=> $validator->errors()
				],200);
		}

	}
}