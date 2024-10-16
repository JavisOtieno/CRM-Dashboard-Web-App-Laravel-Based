<?php

namespace App\Http\Controllers\api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //
    public function index(){

        $contacts = Contact::all();
        return response()->json(['contacts'=>$contacts]);
    }
}
