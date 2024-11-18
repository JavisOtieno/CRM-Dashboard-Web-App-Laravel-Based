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
        $totalDealsThisMonth = Deal::with('account')
        ->whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->sum('amount');
        $target = "500000";   

        $recentdeals = Deal::with('account')->orderBy('id', 'DESC')->take(5)->get();
        return response()->json(compact('target','recentdeals','totalDealsThisMonth'));
    }
}
