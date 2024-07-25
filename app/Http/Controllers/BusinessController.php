<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessStoreRequest;
use App\Http\Requests\BusinessUpdateRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\BusinessResource;
use App\Http\Resources\TaskResource;
use App\Models\Business;
use App\Models\Task;
use Inertia\Inertia;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = BusinessResource::collection(Business::all());

        return Inertia::render('Business/Index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Business/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessStoreRequest $request)
    {
        $business = Business::create($request->validated());
        if ($business) {
            if ($request->category_ids) {
                $business->categories()->sync($request->category_ids);
            }
            if ($request->tag_ids) {
                $business->tags()->sync($request->tag_ids);
            }
        }

        return redirect()->route('businesses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return Inertia::render('Business/Show', ['business' => BusinessResource::make($business),
            'tasks' => TaskResource::collection($business->tasks)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        return inertia::render('Business/Edit', ['business' => BusinessResource::make($business),
            'category_ids' => $business->categories->pluck('id')->all(),
            'tag_ids' => $business->tags()->pluck('id')->all(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessUpdateRequest $request, Business $business)
    {
        $business->update($request->validated());
        $previousTagIds = $business->tags()->pluck('id')->all();
        $previousCategoryIds = $business->categories->pluck('id')->all();

        if ($business) {
            if ($previousCategoryIds != $request->category_ids) {
                $business->categories()->sync($request->category_ids);
            }
            if ($previousTagIds != $request->tag_ids) {
                $business->tags()->sync($request->tag_ids);
            }
        }

        return redirect()->route('businesses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->tags()->detach($business->tags()->pluck('id')->all());
        $business->categories()->detach($business->categories?->pluck('id')->all());
        $business->delete();

        return redirect()->route('businesses.index');
    }

    public function storeTask(TaskStoreRequest $request, Business $business)
    {
        $business->tasks()->save(new Task($request->validated()));
        return redirect()->route('businesses.show', $business->id);
    }
}
