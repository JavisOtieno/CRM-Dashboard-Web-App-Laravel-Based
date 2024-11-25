<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use App\Models\Lead;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function index(){
        // $calls = Call::all();
        $accounts = Account::orderBy('id', 'DESC')->count();
        $contacts = Contact::orderBy('id', 'DESC')->count();
        $deals = Deal::orderBy('id', 'DESC')->count();
        $leads = Lead::orderBy('id', 'DESC')->count();
        
        $user = auth()->user();
        return response()->json(compact('user',
        'accountsCount','contactsCount','dealsCount','leadsCount'));
    }
}
