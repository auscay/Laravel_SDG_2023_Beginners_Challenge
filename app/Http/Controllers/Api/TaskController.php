<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller {
     public function index() {
        $tasks = Task::all();
        return TaskResource::collection($tasks);
     }
     public function show($id) {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
         }
         return new TaskResource($task);
        }
    public function store(Request $request) {
        $validator = Validator::make($request->all(),
        [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'dueDate' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $task = Task::create($request->all());
        return new TaskResource($task);
    }
    public function update(Request $request, $id) {
         $task = Task::find($id);
         if (!$task) {
             return response()->json(['error' => 'Task not found'], 404);
         }
         $validator = Validator::make($request->all(),
         [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'required',
            'dueDate' => 'required'
         ]);
        if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 400);
        }
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->save();
        return new TaskResource($task);
    }
    public function destroy($id) {
         $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404); }
             $task->delete(); return response()->json(null, 204);
        }
    }
