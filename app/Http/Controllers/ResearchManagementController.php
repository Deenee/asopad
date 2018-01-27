<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchManagementController extends Controller
{
    /**
     *  Attach a user with role Reviewer Or Mentor to a Research created by the user with role Researcher.
     *  
     *  @param $user_id ( reviewer | mentor )
     *  @return user,UserResearch
     *  @method @GET
     */
    public function addUserToResearch()
    {
        $user
        request()->user()->research()->attach()->
    }
}
