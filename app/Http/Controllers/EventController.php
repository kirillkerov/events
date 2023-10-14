<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\Event\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return inertia('Event/Index', [
            'title' => 'События',
            'events' => EventResource::collection(Event::orderBy('id', 'DESC')->get())->resolve(), // каждый event запрашивает своего user
//            'events' => Event::with('user')->orderBy('id', 'DESC')->get(), // один общий запрос к users
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
        if ($event->user_id != auth()->user()->id) {
            abort(403);
        }

        return inertia('Event/Edit', [
            'event' => new EventResource($event),
        ]);
    }

    public function update(Event $event, UpdateRequest $request)
    {
        if ($event->user_id != auth()->user()->id) {
            abort(403);
        }

        $event->update($request->validated());
        return redirect()->route('event.index');
    }

    public function delete(Event $event)
    {
        if ($event->user_id != auth()->user()->id) {
            abort(403);
        }

        $event->delete();
        return redirect()->route('event.index');
    }
}
