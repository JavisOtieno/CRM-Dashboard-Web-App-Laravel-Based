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
        $accountsCount = Account::orderBy('id', 'DESC')->count();
        $contactsCount = Contact::orderBy('id', 'DESC')->count();
        $dealsCount = Deal::orderBy('id', 'DESC')->count();
        $leadsCount = Lead::orderBy('id', 'DESC')->count();

        $user = auth()->user();
        return response()->json(compact('user',
        'accountsCount','contactsCount','dealsCount','leadsCount'));
    }
}
