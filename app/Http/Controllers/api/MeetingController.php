<?php

namespace App\Http\Controllers\api;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class meetingcontroller extends Controller
{
    //
    public function index(){
        $meetings = Meeting::with('contact','account')->orderBy('id', 'DESC')->get();
        return response()->json(['meetings'=>$meetings]);
    }

    public function showMeeting($id){
        $meeting = Meeting::with('contact','account')->find($id);
        return response()->json(['meeting'=>$meeting]);
    }

    public function addMeeting(Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'location'=>'required|string|max:255',
            'description'=>'required|string|max:1500',
            'type'=>'required|string|max:255', 
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255',
        ]);

        $incomingFields['user_id']=auth()->user()->id;

        Meeting::create($incomingFields);

        $meetingStatus=array(
            "message" => "Meeting Added Successfully",
            "status" => "success");

        return response()->json($meetingStatus);
    }

    public function submitEditMeeting($id,Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'location'=>'required|string|max:255',
            'description'=>'required|string|max:1500',
            'type'=>'required|string|max:255', 
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255',
        ]);

        $meeting = Meeting::find($id);
        $meeting->update($incomingFields);

        $meetingStatus=array(
            "message" => "Meeting Edited Successfully",
            "status" => "success");

        return response()->json($meetingStatus);
    }
}
