<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Models\Location;
use App\Rules\WordCount;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //

    public function index() {
        //$competitors = Competitor::all();

        $locations = Location::with('account')->get();
        return Inertia::render('Locations',['locations' => $locations]);

    }

    public function newindex() {
        //$competitors = Competitor::all();

        $locations = Location::with('account')->get();
        return Inertia::render('Location/Index',['locations' => $locations]);

    }

    public function showNewEditLocation($id) {
        $location = Location::find($id);
        $accounts = Account::all();
        return Inertia::render('Location/Edit',compact('location','accounts'));
    }

    public function showAddLocation() {
        $accounts = Account::all();
        return Inertia::render('AddLocation',compact('accounts'));
    }
    public function showAddNewLocation() {
        $accounts = Account::all();
        return Inertia::render('Location/Add',compact('accounts'));
    }


    public function submitAddLocation(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            
            'name'=>'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'account_id'=>'required|numeric|digits_between:1,20',
            'description' => ['required', 'string', new WordCount(300)], 
           
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' 
        $incomingFields['user_id']=auth()->user()->id;       

        Location::create($incomingFields);

        // return redirect('/listlocations');
        return redirect('/listlocations')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Location added successfully'
            ]
        ]);

    }

    public function deleteLocation($id) {
        $location = Location::find($id);
        $location->delete();
        // return redirect('/listlocations');
        return redirect('/listlocations')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Location deleted successfully'
            ]
        ]);
    }

    public function showEditLocation($id) {
        $location = Location::find($id);
        $accounts = Account::all();
        return Inertia::render('EditLocation',compact('location','accounts'));
    }

    public function submitEditLocation($id,Request $request) {
        $location = Location::find($id);
        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            
            'name'=>'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'account_id'=>'required|numeric|digits_between:1,20',
            'description' => ['required', 'string', new WordCount(300)], 
           
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        
        //$incomingFields['image']='';

        //return $request['image'];
        $location->update($incomingFields);

        // return redirect('/listlocations');
        return redirect('/listlocations')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Location edited successfully'
            ]
        ]);
    }
}
