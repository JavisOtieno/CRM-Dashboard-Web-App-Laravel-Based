<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Inertia\Inertia;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $leads = Lead::get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Lead/Index',['leads' => $leads]);
    }
    
}
