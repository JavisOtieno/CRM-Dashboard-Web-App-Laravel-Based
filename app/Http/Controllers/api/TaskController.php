<?php

namespace App\Http\Controllers\api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    //
    public function index(){
        $tasks = Task::with('account','contact')->get();
        return response()->json(['tasks'=>$tasks]);
    }
    
}
