<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealController extends Controller
{
    public function index(){
        // $deals = Deal::all();
        $deals = Deal::with('account')->orderBy('id', 'DESC')->get();
        return response()->json(['deals'=>$deals]);
    }

    public function showDeal($id){
        $deal = Deal::with('account')->find($id);
        return response()->json(['deal'=>$deal]);
    }
    //
    public function submitAddDeal(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            'name'=>'required|string|max:255',
            'amount'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
           
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        

        Deal::create($incomingFields);

        $dealStatus=array(
            "message" => "Deal Added Successfully",
            "status" => "success");

        return response()->json($dealStatus);
        
    }
}
