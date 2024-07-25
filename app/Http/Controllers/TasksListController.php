<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tasks = TaskResource::collection(Task::all());

        if ($request->status) {
            $tasks = ($request->status === 'open') ? $tasks->where('status', 'open') : $tasks->where('status', 'completed');
        }

        return response()->json($tasks->all());
    }
}
