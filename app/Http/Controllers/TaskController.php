<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use App\Models\Account;
use App\Models\Contact;
use App\Rules\WordCount;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $tasks = Task::with('account','contact')->get();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Tasks',['tasks' => $tasks]);
    }


    
    public function showAddTask() {
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('AddTask', compact('accounts','contacts'));
    }

    public function submitAddTask(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'name'=>'required|string|max:255',
            'description' => ['required', 'string', new WordCount(300)], 
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        // return $incomingFields;
        
        Task::create($incomingFields);

        return redirect('/tasks');
    }

    public function deleteTask($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect('/meetings');
    }

    public function showEditTask($id) {
        $task = Task::find($id);
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('EditTask',compact('task','accounts','contacts'));
    }

    public function submitEditTask($id,Request $request) {
        $task = Task::find($id);
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'name'=>'required|string|max:255',           
            'description' => ['required', 'string', new WordCount(300)], 
            'status'=>'required|string|max:255',
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        $task->update($incomingFields);

        return redirect('/tasks');
    }
}
