<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $accounts = Account::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Account',['acccounts' => $accounts]);
    }
}

