<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    //
    public function index() {
        $admins = User::where('usertype','admin')->orWhereNull('usertype')->get();
        return Inertia::render('Admin/Index',['admins' => $admins]);
    }
    public function showAddAdmin() {
        return Inertia::render('Admin/Add');
    }
    public function submitAddAdmin(Request $request) {

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', 
            // new PhoneNumber
        ],
            'email'=>'required|string|unique:users|max:255',
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
        $incomingFields['usertype']='admin';
       

        // Store the uploaded file
        $path = $request->file('file')->store('images', 'public');
        $incomingFields['image']=$path;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('images', 'public');
            $incomingFields['image'] = $path;
        }

        

        User::create($incomingFields);

        return redirect('/admins')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Admin added successfully'
            ]
        ]);
    }
    public function deleteAdmin($id) {
        $admin = User::find($id);
        $admin->delete();
        return redirect('/admins')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Admin deleted successfully'
            ]
        ]);
    }

    public function showEditAdmin($id) {
        $admin = User::find($id);
        return Inertia::render('Admin/Edit', ['admin' => $admin]);
    }

    public function showDeleteAdmin($id) {
        $admin = User::find($id);
        return Inertia::render('Admin/Delete', ['admin' => $admin]);
    }

    public function submitEditAdmin($id,Request $request) {
        $admin = User::find($id);

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', 
             new PhoneNumber
        ],
            'email'=>'required|string|max:255|unique:users,email,' . $id,
            'status' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['status']=strip_tags($incomingFields['status']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('images', 'public');
            $incomingFields['image'] = $path;
        }
        

        // $path = $request->file('file')->store('images', 'public');
        // $incomingFields['image']=$path;
        
        //$incomingFields['image']='';

        //return $request['image'];
        $admin->update($incomingFields);

        return redirect('/admins')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Admin edited successfully'
            ]
        ]);
    }
}
