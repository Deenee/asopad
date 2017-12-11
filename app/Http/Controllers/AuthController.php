<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReviewerTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ReviewerTrait, RegisterResearcher;

    public function register()
    {
        if(request()->user_type == 'reviewer'){
            return ReviewerTrait::register();
        }
        if (request()->type == 'researcher') {
            return RegisterResearcher::registerResearcher();
        }
    }
    public function registerReviewer()
    {
        return $this->register();
    }

    public function registerResearcher(Request $request)
    {    
        
    }
}
