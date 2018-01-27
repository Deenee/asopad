<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResponseFormat;
use App\User;
use Validator;
use App\Research;
use DB;

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
     *  
     * When user creates a research, attach user id field to research field(pivot)
     * @param title,description
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
        return DB::transaction(function(){
        $research = Research::create([
                'title'=>request()->title,
                'description'=> request()->description
                ]);
                request()->user()->research()->attach($research->id);
                return $this->response->success($research);
    });
       
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

    /**
     *  Update a Specified research resource.
     *  
     *  @param id
     *  @return research
     *  @method @PUT
     */
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

    /**
     *  Delete a Specified research resource.
     *  
     *  @param id
     *  @return []
     *  @method @DELETE
     */
    public function destroy($id)
    {
        $research = Research::find($id);
        if (!$research) {
            return $this->response->notFound();
        }
        return DB::statement(function(){
            $research->delete();// Instead of deleting it straight away, deactivvate it first and delete after a couple hours. Make the action reversible.
            request()->user()->research()->detach($research->id);
            return $this->response->success([], 'Resource Deleted.');
        });
       
    }


}
