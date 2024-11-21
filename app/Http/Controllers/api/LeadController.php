<?php

namespace App\Http\Controllers\api;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    //
    public function index(){
        $leads = Lead::orderBy('id', 'DESC')->get();
        return response()->json(['leads'=>$leads]); 
    }
}
