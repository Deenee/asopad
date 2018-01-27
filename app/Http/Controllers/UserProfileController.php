<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResponseFormat;
use Log;
use DB;

class UserProfileController extends Controller
{
    public $response;

    public function __construct()
    {
        $this->middleware('auth:api');
        $response = new ResponseFormat;
        $this->response = $response;
    }

    /**
     * Return the user and the user's researches created.
     */
    public function user()
    {
        $user = request()->user()->load('research');
        return $this->response->success($user);
    }

    /**
     * Update User information after sign up or login.
     */
    public function update($id)
    {
        // Not using the query parameter $id but it should be there for now.
        DB::beginTransaction();

            $information = request()->only(['field_of_study', 'phone_number', 'current_location', 'institution_id', 'department_id' ]);
            try{
            request()->user()->update($information);
            }catch(\Throwable $e){

            DB::rollBack();

            Log::info('User Update Failed.', ['Details'=> $e->getMessage()]);
            return $this->response->error([], 'User Update Failed.', '51');
            }

        DB::commit();    
        return $this->response->success(request()->user());
        
    }
    public function createAReview()
    {
        /*  Create a review
                --Review Title
                --Topic
                --Required Field Of Study to match
                --Privacy (No one should see your post)
                --
        
        //  Upload Files to the review
        //  Choose A matching reviewer
        //  Send request To reviewer
        */
    }
    public function createAResearch()
    {
        // Create a new research
        //  --Research Topic
        //  --Research Description
        //  --Research Files

                                //      Create a Research 
                                //          Upload Research Files
    }
    public function upload()
    {
        // Upload and save document.
    }

    public function searchReviewer()
    {
        // Locate a reviewer 
        // --search by name, skill, field of study
    }

    public function placeRequestToReviewer()
    {
        // Send a request to a reviewer to accept with a summary of your project. Maybe the first page or preface.
    }

    public function acceptRequestToReview()
    {
        // Locate a reviewer 
    }

    public function postPaper()
    {
        // Tag a field of study to the post.
    }

    public function matchPaperToReviewerOrMentor()
    {
        
    }

    // Go to profile
    // Search for reviewer based on skill or name
    // Visit reviewer profile to see expertise and experience // i think we should link linkedin // Papers
    // Contact the reviewer
    // Send project or document to the reviewer for reviewing.
    // Reviewer should specify a time range for project completion.
    // Researcher Should attach time frame to the project with a short description.

}
