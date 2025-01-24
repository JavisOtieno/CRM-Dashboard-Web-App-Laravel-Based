<?php

namespace App\Http\Controllers\api;

use App\Models\Lead;
use App\Models\Account;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

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
        
        $incomingFieldsAccount = $incomingFields['account_name'];
        $incomingFieldsAccount['status']='lead';
        Account::create($incomingFieldsAccount);
        Contact::create($incomingFields);

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

    public function submitConvertLead($id,Request $request){
       
        $incomingFields=$request->validate([
            'account_name'=>'required|string|max:255',
            'account_phone' => ['nullable', 'string', 'min:10', 'max:13', new PhoneNumber],
            'account_website'=>'required|string|max:255',
            'account_address'=>'required|string|max:255',
            'contact_name'=>'required|string|max:255',
            'contact_phone'=> ['nullable', 'string', 'min:10', 'max:13', new PhoneNumber],
          
        ]);



        $incomingFieldsAccount['name']=$incomingFields['account_name'];
        $incomingFieldsAccount['phone']=$incomingFields['account_phone'];
        $incomingFieldsAccount['website']=$incomingFields['account_website'];
        $incomingFieldsAccount['address']=$incomingFields['account_address'];
        $incomingFieldsAccount['user_id']=auth()->user()->id;



        $account = Account::create($incomingFieldsAccount);

        $incomingFieldsContact['name']=$incomingFields['contact_name'];
        $incomingFieldsContact['phone']=$incomingFields['contact_phone'];
        $incomingFieldsContact['account_id']=$account->id;
        $incomingFieldsContact['user_id']=auth()->user()->id;

        $contact = Contact::create($incomingFieldsContact);

        $incomingFieldsLead['account_id'] = $account->id;
        $incomingFieldsLead['contact_id'] = $contact->id;
    
        $lead = Lead::find($id);

        $lead->update($incomingFieldsLead);

        $leadStatus=array(
            "message" => "Lead Converted Successfully",
            "account_id" => $account->id,
            "status" => "success");

        return response()->json($leadStatus);
        
    }
    public function showLead($id){
        $lead = Lead::find($id);
        return response()->json(['lead'=>$lead]);
    }
}
