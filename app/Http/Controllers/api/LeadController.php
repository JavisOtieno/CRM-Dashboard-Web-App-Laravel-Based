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
        $leads = Lead::with('user')->orderBy('id', 'DESC')->get();
        return response()->json(['leads'=>$leads]); 
    }
    public function addLead(Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone' => ['nullable', 'string', 'min:10', 'max:13', new PhoneNumber],
            'account_name' => 'nullable|string|max:255',
        ]);

        $incomingFields['user_id']=auth()->user()->id;

        Lead::create($incomingFields);

        $leadStatus=array(
            "message" => "Lead Added Successfully",
            "status" => "success");

        return response()->json($leadStatus);
    }
    public function submitEditLead($id,Request $request){
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone' => ['nullable', 'string', 'min:10', 'max:13', new PhoneNumber],
            'account_name' => 'nullable|string|max:255',
        ]);

    
        $lead = Lead::find($id);

        $lead->update($incomingFields);

        $leadStatus=array(
            "message" => "Lead Edited Successfully",
            "status" => "success");

        return response()->json($leadStatus);
        
    }
    public function showLead($id){
        $lead = Lead::find($id);
        return response()->json(['lead'=>$lead]);
    }
}
