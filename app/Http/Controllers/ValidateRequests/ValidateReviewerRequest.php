<?php 

namespace App\Http\Controllers\ValidateRequests;

use Illuminate\Http\Request;
use Validator;

/**
* Validate reviewer
*/
class ValidateReviewerRequest
{
	protected $rules = [
			'first_name' => 'required',
            'last_name' => 'required',
            'email' =>'required|unique:users|email',
            'phone_number'=> 'required|unique:users',
            'password'  => 'required|confirmed',
            'password_confirmation' => 'required',
            'field_of_study'=> 'required',
            'institution_id'=> 'required',
            'department_id'=> 'required',     
           ];

	function __construct()
	{
		// $this->rules = $rules;
	}

	public function validate()
	{
		$validator = Validator::make(request()->all(), $this->rules);
		if ($validator->fails()) {
			return response()->json([
				'responseMessage' => $validator->errors(),
				'responseCode' => '400',
				'data'=> []
				],200);
		}
	}
}