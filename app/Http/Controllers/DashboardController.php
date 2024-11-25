<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Lead;
use Inertia\Inertia;
use App\Models\Visit;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index() {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();
        $deals= Deal::with('account')->orderBy('id', 'desc')->take(5)->get();
        $accounts = Account::orderBy('id', 'desc')->take(5)->get();

        // return $accounts;
        // return Inertia::render('Index',['deals' => $deals]);
        return Inertia::render('Dashboard',compact('deals','accounts'));
    }

    public function newindex() {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();
        $deals= Deal::with('account')->orderBy('id', 'desc')->take(5)->get();
        $accounts = Account::orderBy('id', 'desc')->take(5)->get();
        $visits = Visit::with('account','location')->take(5)->get();
        $contacts = Contact::with('account')->take(5)->get();
        $dealsCount = Deal::count();
        $accountsCount = Account::count();
        $leadsCount = Lead::count();

        // return $dealsCount;
        
        // return $accounts;
        // return Inertia::render('Index',['deals' => $deals]);
        return Inertia::render('Newdashboard',compact('deals','accounts','visits','contacts',
    'dealsCount','accountsCount','leadsCount'));
    }
}
