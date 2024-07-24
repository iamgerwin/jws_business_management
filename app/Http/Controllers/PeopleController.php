<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonStoreRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Inertia\Inertia;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = PersonResource::collection(Person::all());

        return Inertia::render('People/Index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('People/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonStoreRequest $request)
    {
        $person = Person::create($request->validated());
        // TODO: find clean way to attach
//        if ($person && $request->tag_ids) {
//            foreach ($request->tag_ids as $id) {
//                $person->tags()->attach($id);
//            }
//        }
        if ($person && $request->tag_ids) {
            $person->tags()->sync($request->tag_ids);
        }

        return redirect()->route('people.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        return inertia('People/Edit', ['person' => PersonResource::make($person),
            'tag_ids' => $person->tags()->pluck('id')->all(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonUpdateRequest $request, Person $person)
    {
        $person->update($request->validated());
        $previousTagIds = $person->tags()->pluck('id')->all();

        if ($person && $request->tag_ids != $previousTagIds) {
            $person->tags()->sync($request->tag_ids);
        }

        return redirect()->route('people.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->tags()->detach($person->tags()->pluck('id')->all());
        $person->delete();

        return redirect()->route('people.index');
    }
}
