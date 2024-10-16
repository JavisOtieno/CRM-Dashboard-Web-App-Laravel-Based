<?php

namespace App\Http\Controllers\api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    //
 
    public function index(){
        //$sales = Sale::all();
        // $userId = auth()->id();
        // $accounts = Account::where('user_id',$userId)
        // ->orderBy('id', 'DESC')->with('user','outlet')->get();
        $accounts = Account::all();
        return response()->json(['accounts'=>$accounts]);
    }

}
