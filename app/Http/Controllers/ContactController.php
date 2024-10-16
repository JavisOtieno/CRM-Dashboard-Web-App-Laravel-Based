<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $contacts = Contact::all();
        return Inertia::render('Contacts',['contacts' => $contacts]);
        
    }
}
