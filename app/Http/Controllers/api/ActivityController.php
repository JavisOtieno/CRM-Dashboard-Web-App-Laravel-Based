<?php

namespace App\Http\Controllers\api;

use App\Models\Call;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    //

    public function index(){

        $calls = Call::with('contact', 'account')->get();
        $meetings = Meeting::with('contact', 'account')->get();
        // $visits = Visit::with('location', 'account')->get();

        // Merge and sort
        $activities = $calls->merge($meetings);
        // ->merge($visits);
        $activities = $activities->sortByDesc('created_at')->values();

        return response()->json(['activities'=>$activities]);


    }
}
