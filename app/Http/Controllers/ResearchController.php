<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResponseFormat;
use App\User;
use Validator;
use App\Research;

class ResearchController extends Controller
{
    public $response;
    
    
    public function __construct()
    {   
        $this->middleware('auth:api');
        $response = new ResponseFormat;
        $this->response = $response;
    }

    public function index()
    {
        // eager load user with user's researches / papers 
        $user = request()->user()->load('research');
        return $this->response->success($user);
    }

    public function store ()
    {
        $validator = Validator::make(request()->all(), [
            'title'=> 'required | min:3',
            'description'=> 'required | min:15'
        ]);
        if($validator->fails())
        {
            return $this->response->error($validator->errors(), 'Validation failed!', 40);
        }
       $research = Research::create([
            'title'=>request()->title,
            'description'=> request()->description
            ]);
            return $this->response->success($research);
    }

}
