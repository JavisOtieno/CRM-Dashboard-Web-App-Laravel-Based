<?php

namespace App\Http\Controllers\api;

use App\Models\Call;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Task;
use App\Models\Visit;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    //

    public function index(){
        // $calls = Call::all();
        $accountsCount = Account::orderBy('id', 'DESC')->count();
        $contactsCount = Contact::orderBy('id', 'DESC')->count();
        $dealsCount = Deal::orderBy('id', 'DESC')->count();
        $leadsCount = Lead::orderBy('id', 'DESC')->count();

        $visitsCount = Visit::orderBy('id', 'DESC')->count();
        $meetingsCount = Meeting::orderBy('id', 'DESC')->count();
        $tasksCount = Task::orderBy('id', 'DESC')->count();
        $callsCount = Call::orderBy('id', 'DESC')->count();
        ;
        return response()->json(compact(
        'accountsCount','contactsCount','dealsCount','leadsCount',
        'visitsCount','meetingsCount','tasksCount','callsCount'
        ));
    }
}
