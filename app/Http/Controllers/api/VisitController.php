<?php

namespace App\Http\Controllers\api;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitController extends Controller
{
    //
    public function index(){
        $visits = Visit::with('location','account')->orderBy('id', 'DESC')->get();
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

        Visit::create($incomingFields);

        $visitStatus=array(
            "message" => "Visit Added Successfully",
            "status" => "success");

        return response()->json($visitStatus);
    }
}
