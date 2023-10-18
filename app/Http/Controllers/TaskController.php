<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->orderBy('order')->get();
        return view('task.index', compact('tasks'));
    }

    public function updateOrder(Request $request)
    {
        $taskIds = $request->input('tasks');

        foreach ($taskIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return response()->json(['success' => true]);
    }
}