<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealController extends Controller
{
    public function index(){
        $deals = Deal::all();
        return response()->json(['deals'=>$deals]);
    }
    //
}
