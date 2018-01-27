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

    /**
     *  
     *  
     *  @param @header
     *  @return user,UserResearch
     *  @method @GET
     */
    public function index()
    {
        // eager load user with user's researches / papers 
        $user = request()->user()->load('research');
        return $this->response->success($user);
    }

    /**
     *  Create a new research. Think of a research as a tile or
     *  card that holds all the information of a research(title, files(docs), description, owner, reviewer, mentor, amount charged)
     *  @param title,description
     *  @return research
     *  @method @POST
     */
    public function store ()
    {
        $validator = Validator::make(request()->all(), [
            'title'=> 'required | min:3',
            'description'=> 'required | min:15'
        ]);
        if($validator->fails())
        {
            return $this->response->error($validator->errors(), 'Validation failed!', '40');
        }
       $research = Research::create([
            'title'=>request()->title,
            'description'=> request()->description
            ]);
            return $this->response->success($research);
    }

    /**
     *  Return a Specified research resource.
     *  
     *  @param id
     *  @return research
     *  @method @GET
     */
    public function show($id)
    {
        $research = Research::find($id);
        if(!$research){
            return $this->response->notFound();
        }
        return $this->response->success($research, 'Success, research found.');
    }

    public function update($id)
    {
        $details = request()->only(['title', 'description']);
        $validator = Validator::make($details, [
            'title' => 'required_without:description| min:3',
            'description' => 'required_without:title| min:15',
        ]);
        if ($validator->fails()) {
            return $this->response->error($validator->errors(), 'Validation failed!', '400');
        }

        $research = Research::find($id);
        if(!$research){
            return $this->response->notFound();
        }
        $research->update($details);
        return $this->response->success($research);
    }

}
