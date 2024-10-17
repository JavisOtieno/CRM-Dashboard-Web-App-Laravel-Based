<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $visits = Visit::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Visits',['visits' => $visits]);
    }
    public function showAddVisit() {
        return Inertia::render('AddVisit');
    }
}
