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
        $tasks = Task::with('account','contact')->get();
        return Inertia::render('Task/Index',['tasks' => $tasks]);
    }

    public function newindex() {
        $tasks = Task::with('account','contact')->get();
        return Inertia::render('Tasks',['tasks' => $tasks]);
    }

    
    public function showAddTask() {
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('Task/Add', compact('accounts','contacts'));
    }

    public function submitAddTask(Request $request) {

        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20',
            'name'=>'required|string|max:255',
            'description' => ['required', 'string', new WordCount(300)], 
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
            // new PhoneNumber
            
        ]);
        // return $incomingFields;
        
        Task::create($incomingFields);

        return redirect('/tasks')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Task added successfully'
            ]
        ]);
    }

    public function deleteTask($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect('/tasks')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Task deleted successfully'
            ]
        ]);
    }

    public function showEditTask($id) {
        $task = Task::find($id);
        $accounts = Account::all();
        $contacts = Contact::all();
        return Inertia::render('Task/Edit',compact('task','accounts','contacts'));
    }

    public function submitEditTask($id,Request $request) {
        $task = Task::find($id);
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20',
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'name'=>'required|string|max:255',           
            'description' => ['required', 'string', new WordCount(300)], 
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
            // new PhoneNumber
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        $task->update($incomingFields);

        return redirect('/tasks')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Task edited successfully'
            ]
        ]);
    }
}
