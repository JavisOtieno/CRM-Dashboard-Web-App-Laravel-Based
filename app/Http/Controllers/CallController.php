<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Inertia\Inertia;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;

class CallController extends Controller
{
    //
    public function oldindex() {
        //$competitors = Competitor::all();

        $calls = Call::with('account','contact')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        // return $calls;
        return Inertia::render('Calls',['calls' => $calls]);
    }
    public function index() {

        $calls = Call::with('account','contact')->get();

        return Inertia::render('Call/Index',['calls' => $calls]);
    }
    public function showAddCall() {
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('Call/Add',compact('contacts','accounts'));
    }

    public function submitAddCall(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['account_id']=strip_tags($incomingFields['account_id']);
        $incomingFields['contact_id']=strip_tags($incomingFields['contact_id']);
        $incomingFields['status']=strip_tags($incomingFields['status']);
        
        //$incomingFields['image']='';

        // return $incomingFields;
        

        Call::create($incomingFields);

        return redirect('/calls');
    }

    public function deleteCall($id) {
        $call = Call::find($id);
        $call->delete();
        return redirect('/calls');
    }

    public function showEditCall($id) {
        $call = Call::find($id);
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('Call/Edit', compact('call','contacts','accounts'));
    }

    public function submitEditCall($id,Request $request) {
        $call = Call::find($id);
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['account_id']=strip_tags($incomingFields['account_id']);
        $incomingFields['contact_id']=strip_tags($incomingFields['contact_id']);
        $incomingFields['status']=strip_tags($incomingFields['status']);

       
         
        
        //$incomingFields['image']='';

        //return $request['image'];
        $call->update($incomingFields);

        return redirect('/calls');
    }
    
}
