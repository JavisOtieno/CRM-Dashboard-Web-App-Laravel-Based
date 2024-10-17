<?php

namespace App\Http\Controllers\api;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class meetingcontroller extends Controller
{
    //
    public function index(){
        $meetings = Meeting::all();
        return response()->json(['meetings'=>$meetings]);
    }
}
