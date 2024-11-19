<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Call;
use App\Models\Task;
use App\Models\Visit;
use App\Models\Meeting;
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
        $activities = $tasks->concat($calls)->concat($visits)->concat($meetings);
        $activities = $activities->sortByDesc('created_at')->values();
        // Reset the keys
        $activities = $activities->values();

        return response()->json(['activities'=>$activities]);


    }
    public function activitiesOnThisDate(Request $request){
        $incomingFields = $request->validate(['date'=>'required|string|max:255']);
        $selectedDate = $incomingFields['date'];
        $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->startOfDay();
        

        $calls = Call::with('contact', 'account')
        ->whereDate('created_at', '=', $date)->orderBy('id', 'ASC')->get();
        $meetings = Meeting::with('contact', 'account')
        ->whereDate('created_at', '=', $date)->orderBy('id', 'ASC')->get();
        $visits = Visit::with('location', 'account')
        ->whereDate('created_at', '=', $date)->orderBy('id', 'ASC')->get();
        $tasks = Task::with('contact', 'account')
        ->whereDate('created_at', '=', $date)->orderBy('id', 'ASC')->get();

        // Merge and sort
        $activities = $tasks->concat($calls)->concat($visits)->concat($meetings);
        // sortByDesc
        $activities = $activities->sortBy('created_at')->values();
        // Reset the keys
        $activities = $activities->values();

        return response()->json(['activities'=>$activities]);


    }
}
