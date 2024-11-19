<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index(){
        // $calls = Call::all();
        $user = auth()->user();
        return response()->json(['user'=>$user]);
    }
}
