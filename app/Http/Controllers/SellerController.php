<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class SellerController extends Controller
{
    //
    public function index() {
        $sellers = User::all();
        return Inertia::render('Seller/Index',['sellers' => $sellers]);
    }

    public function newindex() {
        $sellers = User::all();
        return Inertia::render('SellerOld/Index',['sellers' => $sellers]);
    }

    public function showAddSeller() {
        return Inertia::render('Seller/Add');
    }

    public function submitAddSeller(Request $request) {

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', 
            // new PhoneNumber
        ],
            'email'=>'required|string|max:255',
            'status' => 'required|string|max:255',
            'password' => ['required','string','max:255','min:8',
            
            // 'confirmed',
            Password::min(8)->letters()->numbers()],
            'file' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['status']=strip_tags($incomingFields['status']);
       

        // Store the uploaded file
        $path = $request->file('file')->store('images', 'public');
        $incomingFields['image']=$path;
        // return $path;
        
        
        //$incomingFields['image']='';

        //return $request['image'];
        

        User::create($incomingFields);

        return redirect('/sellers');
    }

    public function deleteSeller($id) {
        $seller = User::find($id);
        $seller->delete();
        return redirect('/sellers');
    }

    public function showEditSeller($id) {
        $seller = User::find($id);
        return Inertia::render('Seller/Edit', ['seller' => $seller]);
    }

    public function submitEditSeller($id,Request $request) {
        $seller = User::find($id);

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', 
             new PhoneNumber
        ],
            'email'=>'required|string|max:255',
            'status' => 'required|string|max:255',
            // 'file' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['status']=strip_tags($incomingFields['status']);

        // $path = $request->file('file')->store('images', 'public');
        // $incomingFields['image']=$path;
        
        //$incomingFields['image']='';

        //return $request['image'];
        $seller->update($incomingFields);

        return redirect('/sellers');
    }
    

}
