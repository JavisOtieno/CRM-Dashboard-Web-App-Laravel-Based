<?php

namespace App\Http\Controllers\api;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitController extends Controller
{
    //
    public function index(){
        $visits = Visit::with('location','account','user')->orderBy('id', 'DESC')->get();
        return response()->json(['visits'=>$visits]);
    }

    public function showVisit($id){
        $visit = Visit::with('location','account')->find($id);
        return response()->json(['visit'=>$visit]);
    }

    public function addVisit(Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'location_id'=>'required|numeric|digits_between:1,20', 
            'status'=>'required|string|max:255', 
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 

            // date - time
        ]);

        $incomingFields['user_id']=auth()->user()->id;

        Visit::create($incomingFields);

        $visitStatus=array(
            "message" => "Visit Added Successfully",
            "status" => "success");

        return response()->json($visitStatus);
    }

    public function submitEditVisit($id,Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'location_id'=>'required|numeric|digits_between:1,20', 
            'status'=>'required|string|max:255', 
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 

            // date - time
        ]);

        $visit = Visit::find($id);
        $visit->update($incomingFields);

        $visitStatus=array(
            "message" => "Visit Edited Successfully",
            "status" => "success");

        return response()->json($visitStatus);
    }
}

