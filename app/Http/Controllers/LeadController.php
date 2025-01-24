<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Inertia\Inertia;
use App\Models\Account;
use App\Models\Contact;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $leads = Account::where('status','lead')->with('user','contacts')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Lead/Index',['leads' => $leads]);

    }

    public function showAddLead() {
        return Inertia::render('Lead/Add');
    }
    
    public function showDeleteLead($id) {
        $lead = Account::with('user','contacts')->find($id);
        return Inertia::render('Lead/Delete', ['lead' => $lead]);
    }

    public function submitAddLead(Request $request) {

        

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'account_name'=>'required|string|max:255',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['account_name']=strip_tags($incomingFields['account_name']);

        $incomingFields['user_id']=auth()->user()->id;
        $incomingFieldsAccount['user_id']=auth()->user()->id;
        //$incomingFields['image']='';
        $incomingFieldsAccount['name']=strip_tags($incomingFields['account_name']);
        $incomingFieldsAccount['status']='lead';
        
        $account = Account::create($incomingFieldsAccount);
        $incomingFields['account_id']=$account->id;

        Contact::create($incomingFields);

        //return $request['image'];
    
        // Lead::create($incomingFields);

        // return redirect('/leads');

        return redirect('/leads')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Lead added successfully'
            ]
        ]);
    }

    public function deleteLead($id) {
        $lead = Account::find($id);
        $lead->delete();
        // return redirect('/leads');

        return redirect('/leads')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Lead deleted successfully'
            ]
        ]);
    }

    public function showEditLead($id) {
        $lead = Account::where('status','lead')->with('user','contacts')->find($id);
        return Inertia::render('Lead/Edit', ['lead' => $lead]);
    }

    public function submitEditLead($id,Request $request) {
        $lead = Lead::find($id);

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone' => ['nullable', 'string', 'min:10', 'max:13', new PhoneNumber],
            'account_name' => 'nullable|string|max:255',
        ]);

        $incomingFieldsAccount['name'] = $incomingFields['account_name'];

        $lead = Account::find($id);
        $contact = Contact::where('account_id', $lead->id)->first();

        $lead->update($incomingFieldsAccount);
        $contact->update($incomingFields);

        // return redirect('/leads');
        return redirect('/leads')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Lead edited successfully'
            ]
        ]);

    }
    
}
