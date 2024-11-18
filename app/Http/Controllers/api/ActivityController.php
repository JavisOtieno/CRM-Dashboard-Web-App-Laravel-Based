<?php

namespace App\Http\Controllers\api;

use App\Models\Call;
use App\Models\Visit;
use App\Models\Meeting;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    //

    public function index(){

        $calls = Call::with('contact', 'account')->orderBy('id', 'DESC')->get();
        $meetings = Meeting::with('contact', 'account')->orderBy('id', 'DESC')->get();
        $visits = Visit::with('location', 'account')->orderBy('id', 'DESC')->get();
        $tasks = Task::with('contact', 'account')->orderBy('id', 'DESC')->get();

        // Merge and sort
        $activities = $tasks->merge($visits)->merge($meetings)->merge($calls);
        $activities = $activities->sortByDesc('created_at')->values();

        return response()->json(['activities'=>$activities]);


    }
}
