<?php

namespace App\Http\Controllers\ValidateRequests;

use App\ValidationContract;
use Illuminate\Support\Facades\Log;
use Validator;

/**
* Validate a request coming from a researcher on sign up.
*/
class registerResearcher implements ValidationContract
{
	protected $rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'email'	=>'required|email',
			'password'	=> 'required',
			'password_confirmation'	=> 'confirmed'
			];

	function __construct($rules)
	{
		$this->rules = $rules;
	}
	public function validate($rules = null)
	{
		Log::info('Validating request...');
		$validator = Validator::make(request()->all(),[
			$rules ?: $this->rules
			]);
		if ($validator->fails) {
			Log::info('Validation Failed!',['Data'=>request()]);
			return response()->json([
				'responseMessage'=> 'Validation Failed.',
				'responseCode'=>'400',
				'data'=> []
				],200);
		}
	}
}