<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Person;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $model = match ($request->type) {
            'business' => Business::find($request->id),
            default => Person::find($request->id),
        };
        $tasks = $model->tasks;

        if ($request->status) {
            $tasks = ($request->status === 'open') ? $tasks->where('status', 'open') : $tasks->where('status', 'completed');
        }

        return response()->json($tasks->all());
    }
}
