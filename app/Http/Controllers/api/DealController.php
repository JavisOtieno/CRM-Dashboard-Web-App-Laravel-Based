<?php

namespace App\Http\Controllers\api;

use App\Models\Deal;
use App\Models\Account;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealController extends Controller
{
    public function index(){
        // $deals = Deal::all();
        $deals = Deal::with('account','lead','product')->orderBy('id', 'DESC')->get();
        return response()->json(['deals'=>$deals]);
    }

    public function showDeal($id){
        $deal = Deal::with('account','lead','product')->find($id);
        return response()->json(['deal'=>$deal]);
    }

    public function showEditDeal($id){
        $deal = Deal::with('account','lead','product')->find($id);
        $accounts = Account::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return response()->json(compact('accounts','deal','products'));
    }

    //
    public function addDeal(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'nullable|numeric|digits_between:1,20|exists:accounts,id',
            'lead_id'=>'nullable|numeric|digits_between:1,20|exists:leads,id',
            // 'name'=>'required|string|max:255',
            'product_id'=>'required|numeric|digits_between:1,20|exists:products,id',
            'amount'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
            'accountleadtype'=>'required|string|max:255',
            // new PhoneNumber 
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' 
        $incomingFields['user_id']=auth()->user()->id;       

        Deal::create($incomingFields);

        $dealStatus=array(
            "message" => "Deal Added Successfully",
            "status" => "success");

        return response()->json($dealStatus);
        
    }

    public function submitEditDeal($id,Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            // 'name'=>'required|string|max:255',
            'product_id'=>'required|numeric|digits_between:1,20|exists:products,id',
            'amount'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
           
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        

        $deal = Deal::find($id);

        $deal->update($incomingFields);

        $dealStatus=array(
            "message" => "Deal Edited Successfully",
            "status" => "success");

        return response()->json($dealStatus);
        
    }
}
