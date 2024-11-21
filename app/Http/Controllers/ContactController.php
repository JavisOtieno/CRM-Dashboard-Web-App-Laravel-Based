<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Models\Contact;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $contacts = Contact::with('account')->get();
        // return Inertia::render('Contacts',['contacts' => $contacts]);
        return Inertia::render('Contact/Index',['contacts' => $contacts]);

    }
    public function newindex() {
        //$competitors = Competitor::all();

        $contacts = Contact::with('account')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Contact/Index',['contacts' => $contacts]);
    }
    public function showAddContact() {
        $accounts = Account::all();
        return Inertia::render('Contact/Add',compact('accounts'));
    }


    public function submitAddContact(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'account_id'=>'required|numeric|digits_between:1,20',
           
            // new PhoneNumber
            
        ]);
        $incomingFields['status']='contact';
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        

        Contact::create($incomingFields);

        return redirect('/contacts');
    }

    public function deleteContact($id) {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect('/contacts');
    }

    public function showEditContact($id) {
        $contact = Contact::find($id);
        $accounts = Account::all();
        return Inertia::render('Contact/Edit',compact('contact','accounts'));
    }

    public function showOldEditContact($id) {
        $contact = Contact::find($id);
        $accounts = Account::all();
        return Inertia::render('EditContact',compact('contact','accounts'));
    }

    public function submitEditContact($id,Request $request) {
        $contact = Contact::find($id);
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'account_id'=>'required|numeric|digits_between:1,20',
            
        ]);
        

        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        
        //$incomingFields['image']='';

        //return $request['image'];
        $contact->update($incomingFields);

        return redirect('/contacts');
    }
}
