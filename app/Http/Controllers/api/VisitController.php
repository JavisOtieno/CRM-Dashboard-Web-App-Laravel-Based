<?php

namespace App\Http\Controllers\api;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitController extends Controller
{
    //
    public function index(){
        $visits = Visit::with('location','account')->get();
        return response()->json(['visits'=>$visits]);
    }
}
