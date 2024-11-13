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
    public function showMeeting($id){
        $task = Task::find($id);
        return response()->json(['task'=>$task]);
    }

    public function addTask(Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'description'=>'required|string|max:1500',
            'status'=>'required|string|max:255', 

            // date - time
        ]);

        Task::create($incomingFields);

        $taskStatus=array(
            "message" => "Task Added Successfully",
            "status" => "success");

        return response()->json($taskStatus);
    }
}
