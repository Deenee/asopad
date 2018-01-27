<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ResponseFormat;
use App\Research;
use Validator;

class ResearchManagementController extends Controller
{
    public $response;

    public function __construct()
    {
        $this->middleware('auth:api');
        $response = new ResponseFormat;
        $this->response = $response;
    }
    /**
     *  Attach a user with role Reviewer Or Mentor to a Research created by the user with role Researcher.
     *  
     *  @param $user_id ( reviewer | mentor ), $research_id
     *  @return user,UserResearch
     *  @method @GET
     */
    public function addUserToResearch()
    {
        // Add Validation to check if user is already a part of the research
        $validator = Validator::make(request()->all(),[
            'user_id' => 'required',
            'research_id' => 'required'
        ]);

        // Find the user

        $user = User::find(request()->user_id);

        // Find the research
        $research = Research::find(request()->research_id);
        if(!$user){
            return $this->response->notFound([], 'User Not Found');
        }
        if(!$research){
            return $this->response->notFound([], 'Research Not Found');
        }
        try{
            // Attach a user to the research model.
            $research->user()->attach($user->id);
            return $this->response->success([], 'User has been added to the research.');
        // Add an event to notify users who have been added to the research
        }catch(\Throwable $e){
            return $this->response->error([], 'Error, user has already been added to the research..');
        } 
    }

    public function removeUserFromResearch($id)
    {
        $research = Research::find(request()->research_id);
        $user = User::find($id);
        if(!$research || !$user || $id == request()->user()->id){
            return $this->response->notFound();
        }
        if($research->user()->detach($user->id) == 0){
            return $this->response->response([], 'User is not part of this research.', '400');
        };
        return $this->response->success([], 'User removed from Research.');
    }
}
