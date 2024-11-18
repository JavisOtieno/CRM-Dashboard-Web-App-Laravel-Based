<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function index(){
        // $deals = Deal::all();
        $recentdeals = Deal::with('account')->orderBy('id', 'DESC')->take(5)->get();
        return response()->json(compact('recentdeals'));
    }
}
