<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function index(){
        // $deals = Deal::all();
        $totalDealsUnitsThisMonth = Deal::with('account')
        ->whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->whereHas('product', function ($query) {
            $query->where('target_type', 'quantity'); // Filter by product_type
        })
        ->sum('amount');
        $totalDealsKShThisMonth = Deal::with('account')
        ->whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->whereHas('product', function ($query) {
            $query->where('target_type', 'value'); // Filter by product_type
        })
        ->sum('amount');
        $target = "500000";
        $products = Product::orderBy('id', 'DESC')->get();
        $recentdeals = Deal::with('account')->orderBy('id', 'DESC')->take(5)->get();

        return response()->json(compact('products','target','recentdeals',
        'totalDealsKShThisMonth','totalDealsUnitsThisMonth'));
    }
}
