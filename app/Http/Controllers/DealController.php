<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DealController extends Controller
{
    //
    public function index() {
        $deals = Deal::all();
        return Inertia::render('Deals',['deals' => $deals]);
    }
}
