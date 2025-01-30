<?php

namespace App\Http\Controllers\api;

use App\Models\Templocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplocationController extends Controller
{
    //
    public function addTemplocation(Request $request){

       
        $incomingFields=$request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
        ]);

        $incomingFields['user_id']=auth()->user()->id;

        Templocation::create($incomingFields);

        $locationStatus=array(
            "message" => "Location Added Successfully",
            "status" => "success");

        return response()->json($locationStatus);
    }
}
