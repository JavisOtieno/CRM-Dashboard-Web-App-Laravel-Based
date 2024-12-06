<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Inertia\Inertia;
use App\Models\Account;
use App\Models\Product;
use Illuminate\Http\Request;

class DealController extends Controller
{
    //
    // public function index() {
    //     $deals = Deal::with('account','user')->get();
    //     return Inertia::render('Deals',['deals' => $deals]);
    // }
    public function newindex() {
        //$competitors = Competitor::all();

        $deals = Deal::with('account','user')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Deal/Index',['deals' => $deals]);
    }
    public function showAddDeal() {
        $accounts = Account::all();
        $products = Product::all();
        return Inertia::render('Deal/Add',compact('accounts','products'));
    }


    public function submitAddDeal(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20|exists:accounts,id',
            'product_id'=>'required|numeric|digits_between:1,20|exists:products,id',
            'amount'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
           
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'  
        $incomingFields['user_id']=auth()->user()->id;      

        Deal::create($incomingFields);

        // return redirect('/newdeals');
        return redirect('/newdeals')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Deal added successfully'
            ]
        ]);

  
    }

    public function deleteDeal($id) {
        $deal = Deal::find($id);
        $deal->delete();
        // return redirect('/newdeals');
        return redirect('/newdeals')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Deal deleted successfully'
            ]
        ]);

        // $dealStatus=array(
        //     "message" => "Deal Deleted Successfully",
        //     "status" => "success");

        // return response()->json($dealStatus);

    }

    public function showEditDeal($id) {
        $deal = Deal::find($id);
        $accounts = Account::all();
        $products = Product::all();
        return Inertia::render('Deal/Edit', compact('deal','accounts','products'));
    }

    public function submitEditDeal($id,Request $request) {
        $deal = Deal::find($id);
        
        $incomingFields=$request->validate([
            'amount'=>'required|numeric|digits_between:1,20',
            'status'=>'required|string|max:255',
            'account_id'=>'required|numeric|digits_between:1,20|exists:accounts,id',
            'product_id'=>'required|numeric|digits_between:1,20|exists:products,id',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        
        //$incomingFields['image']='';

        //return $request['image'];
        $deal->update($incomingFields);

        // return redirect('/newdeals');
        return redirect('/newdeals')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Deal edited successfully'
            ]
        ]);
    }
}
