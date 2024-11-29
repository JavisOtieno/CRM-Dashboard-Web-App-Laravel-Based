<?php

namespace App\Http\Controllers\api;

use App\Models\Lead;
use App\Models\Account;
use App\Models\Contact;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //
    public function index(){
        $contacts = Contact::with('account')
        // ->where('status','contact')
        ->orderBy('id', 'DESC')->get();
        return response()->json(['contacts'=>$contacts]); 
    }



    public function showContact($id){
        $contact = Contact::with('account')->find($id);
        return response()->json(['contact'=>$contact]);
    }

    public function addContact(Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'account_id'=>'required|numeric|digits_between:1,20',  
        ]);

        // $incomingFields['status']='contact';
        $incomingFields['user_id']=auth()->user()->id;

        Contact::create($incomingFields);

        $contactStatus=array(
            "message" => "Contact Added Successfully",
            "status" => "success");

        return response()->json($contactStatus);
    }


    public function submitEditContact($id,Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'account_id'=>'required|numeric|digits_between:1,20',  
        ]);

        // $incomingFields['status']='contact';

        $contact = Contact::find($id);
        $contact->update($incomingFields);

        $contactStatus=array(
            "message" => "Contact Edited Successfully",
            "status" => "success");

        return response()->json($contactStatus);
    }

}
