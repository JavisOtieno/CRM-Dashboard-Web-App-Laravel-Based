<?php

namespace App\Http\Controllers\api;

use App\Models\Lead;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    //
    public function index(){
        $leads = Lead::orderBy('id', 'DESC')->get();
        return response()->json(['leads'=>$leads]); 
    }
    public function addLead(Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone' => ['nullable', 'string', 'min:10', 'max:13', new PhoneNumber],
            'account_name' => 'nullable|string|max:255',
        ]);

    

        Lead::create($incomingFields);

        $leadStatus=array(
            "message" => "Lead Added Successfully",
            "status" => "success");

        return response()->json($leadStatus);
    }
}
