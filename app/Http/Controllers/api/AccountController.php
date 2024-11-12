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

    public function addAccount(Request $request){

       
        //$incomingFields=
        $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'website'=>'required|string|max:255',
            'address'=>'required|string|max:1500',
        ]);


        // $incomingFields=[];
        // $incomingFields['user_id']=strip_tags($request['userId']);
        // $incomingFields['visit_id']=strip_tags($request['visitId']);
        // $incomingFields['outlet_id']=strip_tags($request['outletId']);
        // $incomingFields['feedback']=strip_tags($request['feedback']);
        // $incomingFields['organization_id']=auth()->user()->organization_id;
        // $incomingFields['team_id']=auth()->user()->team_id;


        Account::create($request);

        $accountStatus=array(
            "message" => "Account Saved Successfully",
            "status" => "success");

        return response()->json($accountStatus);
        
    }

}
