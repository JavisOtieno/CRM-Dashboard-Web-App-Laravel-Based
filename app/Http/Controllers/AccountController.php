<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    // public function index() {
    //     //$competitors = Competitor::all();

    //     $accounts = Account::with('user')->get();
    //     $accounts = Account::with('user')->orderBy('id', 'DESC')->get();
    //     // return view('com', ['competitors'=>$competitors]);-
    //     return $accounts[0];
    //     // return Inertia::render('Accounts',['accounts' => $accounts]);
    // }

    public function newindex() {
        //$competitors = Competitor::all();

        // $accounts = Account::all();
                $accounts = Account::where('status','account')->with('user')->orderBy('id', 'DESC')->get();
                if(auth()->user()->usertype=='admin'){
                    $admin = true;
                }else{
                    $admin = false;
                }
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0];
        return Inertia::render('Account/Index',compact('admin','accounts'));
    }

    public function altindex(Request $request) {
        //$competitors = Competitor::all();

        // $accounts = Account::all();
        
        // $accounts = Account::with('user')->orderBy('id', 'DESC')->get();
        // $accounts = Account::paginate(10);
        $entries = $request->only('entries');
        // return $request;
        $perPage = $entries['entries'] ?? 10;  // Default to 10 entries per page if not provided
       

        $accounts = Account::where('status','account')->paginate($perPage); // Adjust the number per page as needed
        
        if(auth()->user()->usertype=='admin'){
            $admin = true;
        }
        else{
            $admin = false;
        }
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts;
        $query = $request->input('search');

        // $query = $request->input('search');
        $filters = $request->only('search', 'entries');
        

        // return $request;

        $accounts = Account::where('status','account')->query() // Assuming you have an Account model
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")    
                    ->orWhere('website', 'like', "%{$query}%")  
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('address', 'like', "%{$query}%"); 
                });
            })
            // $accounts = Account::where('name', 'like', "%{$query}%")
            ->paginate($perPage); // Adjust the pagination size

        $paginationInfo = [
            'from' => $accounts->firstItem(),
            'to' => $accounts->lastItem(),
            'total' => $accounts->total(),
        ];

            // return $accounts;


        return Inertia::render('Account/AltIndex',compact('admin','accounts','paginationInfo','filters'));
    }

    public function showAddAccount() {
        return Inertia::render('Account/Add');
    }

    public function submitAddAccount(Request $request) {

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'website'=>'required|string|max:255',
            'address' => 'required|string|max:255',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['website']=strip_tags($incomingFields['website']);
        $incomingFields['address']=strip_tags($incomingFields['address']);
        $incomingFields['status']='account';
        $incomingFields['user_id']=auth()->user()->id;
        
        //$incomingFields['image']='';
        //return $request['image'];
        

        Account::create($incomingFields);

        // return redirect('/accounts');
        
        return redirect('/accounts')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Account added successfully'
            ]
        ]);

    }

    public function deleteAccount($id) {
        $account = Account::find($id);
        $account->delete();
        // return redirect('/accounts');
        return redirect('/accounts')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Account deleted successfully'
            ]
        ]);
    }

    public function showEditAccount($id) {
        $account = Account::with('user')->find($id);
        return Inertia::render('Account/Edit', ['account' => $account]);
    }

    public function showDeleteAccount($id) {
        $account = Account::with('user')->find($id);
        return Inertia::render('Account/Delete', ['account' => $account]);
    }

    public function submitEditAccount($id,Request $request) {
        $account = Account::find($id);

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:13', new PhoneNumber],
            'website'=>'required|string|max:255',
            'address' => 'required|string|max:255',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['website']=strip_tags($incomingFields['website']);
        $incomingFields['address']=strip_tags($incomingFields['address']);

        
        //$incomingFields['image']='';

        //return $request['image'];
        $account->update($incomingFields);

        // return redirect('/accounts');

        return redirect('/accounts')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Account edited successfully'
            ]
        ]);
        
    }
    

}

