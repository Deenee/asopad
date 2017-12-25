<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReviewerTrait;
use App\Http\Controllers\Traits\ResearcherTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ReviewerTrait, ResearcherTrait;

/*
*user type can be researcher/ reviewer
*/
    public function register()
    {
        //place traits in user model later .
        if(request()->user_type == 'reviewer'){
            return ReviewerTrait::registerReviewer();
        }
        if (request()->user_type == 'researcher') {
            return ResearcherTrait::registerResearcher();
        }
    }
  
}
