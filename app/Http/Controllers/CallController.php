<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CallController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $calls = Call::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Calls',['calls' => $calls]);
    }
    public function showAddCall() {
        return Inertia::render('AddCall');
    }
}
