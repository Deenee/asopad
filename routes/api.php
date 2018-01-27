<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return [[$request->user()]];
// });

Route::group(['prefix'=>'v1'], function()
{
	Route::group(['prefix'=>'auth'], function(){
		// Route::post('/{user_type}', 'AuthController@register');
	Route::post('register', 'AuthController@simpleRegistration');
	
	Route::group(['prefix' => 'email'], function () {
		Route::post('send', 'EmailController@resendVerificationEmail');
		Route::get('verify/{email_token}', 'EmailController@verifyEmailWhenUserClicksVerificationButton');
		});
	});

	// Route::group(['prefix' => 'profile'], function () {
		Route::get('user', 'UserProfileController@user');
		Route::put('user/{id}', 'UserProfileController@update');
	// });


	// Research Crud
	Route::get('researches', 'ResearchController@index');
	Route::post('researches', 'ResearchController@store');
	Route::get('researches/{id}', 'ResearchController@show');
	Route::put('researches/{id}', 'ResearchController@update');
	Route::delete('researches/{id}', 'ResearchController@destroy');

	// Research Management
	// Assign a user with role: mentor or reviewer, to a research
	Route::post('researches/{id}/manage', 'ResearchController@index');

	// Pay cost of assigning a user to your research.
	// Calculate bill.
	// Remove a user from research.
	// Pay reearch cost.
	

	
});



