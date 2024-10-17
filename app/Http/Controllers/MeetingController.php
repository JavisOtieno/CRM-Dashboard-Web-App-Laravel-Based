<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $meetings = Meeting::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Meetings',['meetings' => $meetings]);
    }
    public function showAddMeeting() {
        return Inertia::render('AddMeeting');
    }
}
