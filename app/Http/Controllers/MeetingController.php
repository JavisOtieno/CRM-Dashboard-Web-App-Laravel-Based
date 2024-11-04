<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Meeting;
use App\Rules\WordCount;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $meetings = Meeting::with('account','contact')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        // return $meetings;
        return Inertia::render('Meeting/Index',['meetings' => $meetings]);
    }

    public function newindex() {
        //$competitors = Competitor::all();

        $meetings = Meeting::with('account','contact')->get();
        return Inertia::render('Meetings',['meetings' => $meetings]);
    }

    public function showAddMeeting() {
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('Meeting/Add',compact('accounts','contacts'));
    }

    public function submitAddMeeting(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'type'=>'required|string|max:255',
            'location'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255',
            'description' => ['required', 'string', new WordCount(300)], 
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        
        Meeting::create($incomingFields);

        return redirect('/meetings');
    }

    public function deleteMeeting($id) {
        $meeting = Meeting::find($id);
        $meeting->delete();
        return redirect('/meetings');
    }

    public function showEditMeeting($id) {
        $meeting = Meeting::find($id);
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('Meeting/Edit', compact('meeting','accounts','contacts'));
    }

    public function submitEditMeeting($id,Request $request) {
        $meeting = Meeting::find($id);
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'type'=>'required|string|max:255',
            'location'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255',           
            'description' => ['required', 'string', new WordCount(300)], 
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $meeting->update($incomingFields);

        return redirect('/meetings');
    }
}
