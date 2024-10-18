<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index() {
        //$competitors = Competitor::all();

        $tasks = Task::all();
        // return view('com', ['competitors'=>$competitors]);-
        // return $accounts[0]['name'];
        return Inertia::render('Tasks',['tasks' => $tasks]);
    }
    public function showAddTask() {
        return Inertia::render('AddTask');
    }
}
