<?php

namespace App\Http\Controllers\api;

use App\Models\Account;
use App\Rules\PhoneNumber;
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

    public function Account(Request $request){

       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'website'=>'required|string|max:255',
            'address'=>'required|string|max:1500',
        ]);

        Account::create($incomingFields);

        $accountStatus=array(
            "message" => "Account Saved Successfully",
            "status" => "success");

        return response()->json($accountStatus);
        
    }

}
