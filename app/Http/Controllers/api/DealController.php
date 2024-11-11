<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealController extends Controller
{
    public function index(){
        // $deals = Deal::all();
        $deals = Deal::with('account')->get();
        return response()->json(['deals'=>$deals]);
    }
    //
}
