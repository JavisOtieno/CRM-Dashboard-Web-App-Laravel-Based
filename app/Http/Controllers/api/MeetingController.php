<?php

namespace App\Http\Controllers\api;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class meetingcontroller extends Controller
{
    //
    public function index(){
        $meetings = Meeting::with('contact','account')->get();
        return response()->json(['meetings'=>$meetings]);
    }

    public function showMeeting($id){
        $meeting = Meeting::find($id);
        return response()->json(['meeting'=>$meeting]);
    }

    public function addMeeting(Request $request){
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'account_id'=>'required|numeric|digits_between:1,20', 
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'description'=>'required|string|max:1500',
            'type'=>'required|string|max:255', 
            'location'=>'required|string|max:255', 
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255',
        ]);

        Meeting::create($incomingFields);

        $meetingStatus=array(
            "message" => "Meeting Added Successfully",
            "status" => "success");

        return response()->json($meetingStatus);
    }
}
