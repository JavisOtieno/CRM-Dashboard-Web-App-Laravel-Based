<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();
        // $contacts = Contact::with('account')->get();

        return Inertia::render('AuthNew/Login');

    }
    

    public function signup() {

        return Inertia::render('AuthNew/Signup');

    }
    public function showForgotPassword() {

        return Inertia::render('AuthNew/ForgotPassword');

    }

    public function profile() {
        //$competitors = Competitor::all();
        // $contacts = Contact::with('account')->get();
        $user = auth()->user();

        return Inertia::render('ProfileNew/Profile',compact('user'));

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function doLogin(Request $request){

        // abort(403);
        
        $credentials = $request->validate([
            'email'=>'required|email|max:255',
            'password' => 'required|max:255|min:8|string',
        ]);
        //return 'test';
        // abort(403);
        
        // $request->authenticate();
        // $request->session()->regenerate();
        // return redirect()->intended('newdashboard');
 
        
        
        if (Auth::attempt($credentials)) {

            // $request->authenticate();
            $request->session()->regenerate();
            return redirect('/dashboard');

        }
        else{
          return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        

    }
    
}
