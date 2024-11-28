<?php

namespace App\Http\Controllers\api;

use App\Models\Call;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallController extends Controller
{
    //
    public function index(){
        // $calls = Call::all();
        $calls = Call::with('contact','account')->orderBy('id', 'DESC')->get();
        return response()->json(['calls'=>$calls]);
    }

    public function showCall($id){
        $call = Call::with('contact','account')->find($id);
        return response()->json(['call'=>$call]);
    }

    public function addCall(Request $request){

       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
            'status'=>'required|string|max:255',
        ]);

        Call::create($incomingFields);

        $callStatus=array(
            "message" => "Call Added Successfully",
            "status" => "success");

        return response()->json($callStatus);
    }
        
    public function submitEditCall($id,Request $request){

       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
            'status'=>'required|string|max:255',
        ]);

        $call = Call::find($id);
        $call->update($incomingFields);

        $callStatus=array(
            "message" => "Call Edited Successfully",
            "status" => "success");

        return response()->json($callStatus);
    }
        
    
}
