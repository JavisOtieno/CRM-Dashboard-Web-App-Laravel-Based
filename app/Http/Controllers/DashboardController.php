<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Inertia\Inertia;
use App\Models\Account;
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
}
