<?php

namespace App\Http\Controllers\api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    //
    public function index(){
        $tasks = Task::with('account','contact','user')->orderBy('id', 'DESC')->get();
        return response()->json(['tasks'=>$tasks]);
    }
    public function showTask($id){
        $task = Task::with('account','contact','user')->find($id);
        return response()->json(['task'=>$task]);
    }

    public function addTask(Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'name'=>'required|string|max:255', 
            'description'=>'required|string|max:1500',
            'status'=>'required|string|max:255', 
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 

            // date - time
        ]);

        $incomingFields['user_id']=auth()->user()->id;

        Task::create($incomingFields);

        $taskStatus=array(
            "message" => "Task Added Successfully",
            "status" => "success");

        return response()->json($taskStatus);
    }

    public function submitEditTask($id,Request $request){
       
        $incomingFields=$request->validate([
            'account_id'=>'required|numeric|digits_between:1,20', 
            'contact_id'=>'required|numeric|digits_between:1,20', 
            'name'=>'required|string|max:255', 
            'description'=>'required|string|max:1500',
            'status'=>'required|string|max:255', 
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 

            // date - time
        ]);

        $task = Task::find($id);
        $task->update($incomingFields);

        $taskStatus=array(
            "message" => "Task Edited Successfully",
            "status" => "success");

        return response()->json($taskStatus);
    }
}
