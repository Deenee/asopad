<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function user()
    {
        return response()->json([
            'responseMessage' => 'User Authenticated.',
            'responseCode' => '200',
            'data' => [request()->user()]
        ]);
    }
}
