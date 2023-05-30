<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json(['data' => $tasks], 200);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json(['data' => $task], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'dueDate' => 'required|date_format:d-m-y',
        ]);

        $task = Task::create($validatedData);
        return response()->json(['data' => $task], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'dueDate' => 'required|date_format:d-m-y',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validatedData);
        return response()->json(['data' => $task], 200);
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
