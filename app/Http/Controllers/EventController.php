<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\Event\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('event.owner')->only(['edit', 'update', 'delete']);
    }

    public function index()
    {
//        а вот так было бы меньше запросов если повторяются user
//        мб сделать EventWithUserResource?
//        'events' => Event::with('user')->orderBy('id', 'DESC')->get(),
        return inertia('Event/Index', [
            'title' => 'События',
            'events' => EventResource::collection(Event::orderBy('id', 'DESC')->get())->resolve(),
        ]);
    }

    public function create()
    {
        return inertia('Event/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        Event::create($data);

        return redirect()->route('event.index');
    }

    public function show(Event $event)
    {
        return inertia('Event/Show', [
            'event' => new EventResource($event),
        ]);
    }

    public function edit(Event $event)
    {
        return inertia('Event/Edit', [
            'event' => $event,
        ]);
    }

    public function update(Event $event, UpdateRequest $request)
    {
        $event->update($request->validated());
        return redirect()->route('event.index');
    }

    public function delete(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index');
    }
}
