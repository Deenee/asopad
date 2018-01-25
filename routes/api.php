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
		Route::get('verify/{email_token}', 'EmailController@verifyEmail');
		});
	});

	Route::group(['prefix' => 'profile'], function () {
		Route::get('user', 'UserProfileController@user');
		Route::put('user/{$id}', 'UserProfileController@update');
	});

	Route::get('researches', 'ResearchController@index');
	Route::post('researches', 'ResearchController@store');
	Route::get('researches/{id}', 'ResearchController@show');
	// Route::get('researches', 'ResearchController@index');
	// Route::get('researches', 'ResearchController@index');
	

	
});



