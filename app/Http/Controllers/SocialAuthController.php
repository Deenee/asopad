<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        dd($user);
      	$authUser = $this->findOrCreateUser($user, $provider);
      	$authUser->createToken('token')->accessToken;
        // Auth::login($authUser, true);
        $url = 'http://127.0.0.1:8000';
        $client = new Client();
        $request = $client->post("$url/oauth/token",['form-params'=>[
        	'username'=>$authUser->email,
        	'password'=>$auth
        	]]);
        $response = $request->getBody();
        return $response = json_decode($response);
        return redirect('/oauth/token');
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser->createToken('token')->accessToken;//should return authuser with token
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}