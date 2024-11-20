<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Visit;
use App\Models\Account;
use App\Models\Location;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $visits = Visit::with('account','location')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Visits',['visits' => $visits]);
    }
    
    public function newindex() {
        $visits = Visit::with('account','location')->get();
        return Inertia::render('Visit/Index',['visits' => $visits]);
    }

    public function showAddVisit() {
        $accounts = Account::all();
        $locations = Location::all();
        // return $locations;
        return Inertia::render('Visit/Add',compact('locations','accounts'));
    }
    public function submitAddVisit(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            'location_id'=>'required|numeric|digits_between:1,20',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['account_id']=strip_tags($incomingFields['account_id']);
        $incomingFields['location_id']=strip_tags($incomingFields['location_id']);
        $incomingFields['status']=strip_tags($incomingFields['status']);
        $incomingFields['date']=strip_tags($incomingFields['date']);
        $incomingFields['time']=strip_tags($incomingFields['time']);
        
        //$incomingFields['image']='';

        // return $incomingFields;
        

        Visit::create($incomingFields);

        return redirect('/visits');
    }

    public function deleteVisit($id) {
        $visit = Visit::find($id);
        $visit->delete();
        return redirect('/visits');
    }

    public function showEditVisit($id) {
        $visit = Visit::find($id);
        $accounts = Account::all();
        $locations = Location::all();
        return Inertia::render('Visit/Edit', compact('accounts','locations','visit'));
    }

    public function submitEditVisit($id,Request $request) {
        $visit = Visit::find($id);
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'location_id'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['account_id']=strip_tags($incomingFields['account_id']);
        $incomingFields['location_id']=strip_tags($incomingFields['location_id']);
        $incomingFields['status']=strip_tags($incomingFields['status']);
        $incomingFields['date']=strip_tags($incomingFields['date']);
        $incomingFields['time']=strip_tags($incomingFields['time']);

       
         
        
        //$incomingFields['image']='';

        //return $request['image'];
        $visit->update($incomingFields);

        return redirect('/visits');
    }
}
