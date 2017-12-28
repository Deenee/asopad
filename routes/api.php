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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return [[$request->user()]];
});

Route::group(['prefix'=>'v1'], function(){
	Route::group(['prefix'=>'register'], function(){
		// Route::post('/{user_type}', 'AuthController@register');
	Route::post('/', 'AuthController@simpleRegistration');
	});
	
	Route::get('user', 'AuthController@user');

	Route::group(['prefix' => 'email/verification'], function () {
	Route::post('send', 'EmailController@resendVerificationEmail');
	Route::post('confirm', 'EmailController@verifyEmail');	
	});
});