<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Inertia\Inertia;
use App\Models\Account;
use Illuminate\Http\Request;

class DealController extends Controller
{
    //
    public function index() {
        $deals = Deal::with('account')->get();
        return Inertia::render('Deals',['deals' => $deals]);
    }
    public function showAddDeal() {
        $accounts = Account::all();
        return Inertia::render('AddDeal',compact('accounts'));
    }


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

        return redirect('/deals');
    }

    public function deleteDeal($id) {
        $deal = Deal::find($id);
        $deal->delete();
        return redirect('/deals');
    }

    public function showEditDeal($id) {
        $deal = Deal::find($id);
        $accounts = Account::all();
        return Inertia::render('EditDeal', compact('deal','accounts'));
    }

    public function submitEditDeal($id,Request $request) {
        $deal = Deal::find($id);
        $incomingFields=$request->validate([
            'amount'=>'required|numeric|digits_between:1,20',
            'name'=>'required|string|max:255',
            'status'=>'required|string|max:255',
            'account_id'=>'required|numeric|digits_between:1,20',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        
        //$incomingFields['image']='';

        //return $request['image'];
        $deal->update($incomingFields);

        return redirect('/deals');
    }
}
