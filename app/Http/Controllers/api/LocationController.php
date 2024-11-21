<?php

namespace App\Http\Controllers\api;

use App\Models\Location;
use App\Models\Location;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    //
    public function index(){
        $locations = Location::with('account')->orderBy('id', 'DESC')->get();;
        return response()->json(['locations'=>$locations]); 
    }

    public function showLocation($id){
        $location = Location::with('account')->find($id);
        return response()->json(['location'=>$location]);
    }

    public function addLocation(Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'account_id'=>'required|numeric|digits_between:1,20',  
        ]);

        Location::create($incomingFields);

        $locationStatus=array(
            "message" => "Location Added Successfully",
            "status" => "success");

        return response()->json($locationStatus);
    }
}
