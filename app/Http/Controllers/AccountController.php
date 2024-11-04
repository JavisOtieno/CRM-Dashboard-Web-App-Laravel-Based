<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $accounts = Account::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Accounts',['accounts' => $accounts]);
    }

    public function newindex() {
        //$competitors = Competitor::all();

        $accounts = Account::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Account/Index',['accounts' => $accounts]);
    }

    public function showAddAccount() {
        return Inertia::render('Account/Add');
    }

    public function submitAddAccount(Request $request) {

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', 
            // new PhoneNumber
        ],
            'website'=>'required|string|max:255',
            'address' => 'required|string|max:255',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['website']=strip_tags($incomingFields['website']);
        $incomingFields['address']=strip_tags($incomingFields['address']);
        
        //$incomingFields['image']='';

        //return $request['image'];
        

        Account::create($incomingFields);

        return redirect('/accounts');
    }

    public function deleteAccount($id) {
        $account = Account::find($id);
        $account->delete();
        return redirect('/accounts');
    }

    public function showEditAccount($id) {
        $account = Account::find($id);
        return Inertia::render('Account/Edit', ['account' => $account]);
    }

    public function submitEditAccount($id,Request $request) {
        $account = Account::find($id);

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', 
            // new PhoneNumber
        ],
            'website'=>'required|string|max:255',
            'address' => 'required|string|max:255',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['website']=strip_tags($incomingFields['website']);
        $incomingFields['address']=strip_tags($incomingFields['address']);
        
        //$incomingFields['image']='';

        //return $request['image'];
        $account->update($incomingFields);

        return redirect('/accounts');
    }
    

}

