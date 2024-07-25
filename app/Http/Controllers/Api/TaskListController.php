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
         switch ($request->type) {
            case 'business':
                $b = Business::find($request->id);
                return response()->json($b->tasks->all());
             default:
                 $p = Person::find($request->id);
                 return response()->json($p->tasks->all());
        }
    }
}
