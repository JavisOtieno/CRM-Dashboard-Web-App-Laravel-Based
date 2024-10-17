<?php

namespace App\Http\Controllers\api;

use App\Models\Call;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallController extends Controller
{
    //
    public function index(){
        $calls = Call::all();
        return response()->json(['calls'=>$calls]);
    }
}
