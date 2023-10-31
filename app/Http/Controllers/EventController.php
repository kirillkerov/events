<?php

namespace App\Http\Controllers;

use App\Events\EventStored;
use App\Events\EventDeleted;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\Event\EventResource;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class EventController extends Controller
{
    /**
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        return inertia('Event/Index', [
            'title' => 'События',
            'events' => EventResource::collection(Event::orderBy('id', 'DESC')->get())->resolve(), // каждый event запрашивает своего user
//            'events' => Event::with('user')->orderBy('id', 'DESC')->get(), // один общий запрос к users ?
        ]);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Event/Create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $event = Event::create($data);

        broadcast(new EventDeleted($event))->toOthers();

        return redirect()->route('event.index');
    }

    /**
     * @param Event $event
     * @return Response|ResponseFactory
     */
    public function show(Event $event): Response|ResponseFactory
    {
        return inertia('Event/Show', [
            'event' => EventResource::make($event)->resolve(),
        ]);
    }

    /**
     * @param Event $event
     * @return Response|ResponseFactory
     */
    public function edit(Event $event): Response|ResponseFactory
    {
        if ($event->user_id != auth()->user()->id) {
            abort(403);
        }

        return inertia('Event/Edit', [
            'event' => EventResource::make($event)->resolve(),
        ]);
    }

    /**
     * @param Event $event
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(Event $event, UpdateRequest $request): RedirectResponse
    {
        if ($event->user_id != auth()->user()->id) {
            abort(403);
        }

        $event->update($request->validated());
        return redirect()->route('event.index');
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     */
    public function delete(Event $event): RedirectResponse
    {
        if ($event->user_id != auth()->user()->id) {
            abort(403);
        }

        $eventId = $event->id;

        if ($event->delete()) {
            broadcast(new EventStored($eventId))->toOthers();
        }

        return redirect()->route('event.index');
    }
}
