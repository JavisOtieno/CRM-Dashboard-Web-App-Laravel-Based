<?php

namespace App\Http\Controllers\api;

use App\Models\Account;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    //
    public function index(){
        $locations = Location::with('account','user')->orderBy('id', 'DESC')->get();;
        return response()->json(['locations'=>$locations]); 
    }



    public function showLocation($id){
        $location = Location::with('account')->find($id);
        return response()->json(['location'=>$location]);
    }

    public function addLocation(Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'description' =>'required|string|max:1500',
            'account_id'=>'required|numeric|digits_between:1,20',  
        ]);

        $incomingFields['user_id']=auth()->user()->id;

        Location::create($incomingFields);

        $locationStatus=array(
            "message" => "Location Added Successfully",
            "status" => "success");

        return response()->json($locationStatus);
    }
    public function submitEditLocation($id,Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'description' =>'required|string|max:1500',
            'account_id'=>'required|numeric|digits_between:1,20',  
        ]);

        $location = Location::find($id);
        $location->update($incomingFields);

        $locationStatus=array(
            "message" => "Location Edited Successfully",
            "status" => "success");

        return response()->json($locationStatus);
    }

}
