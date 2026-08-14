<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of events with their check-in counts.
     *
     * @return View
     */
    public function index(): View
    {
        $events = Event::withCount('checkins')->latest()->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the event creation form.
     *
     * @return View
     */
    public function create(): View
    {
        return view('events.create');
    }

    /**
     * Store a newly created event.
     *
     * @param StoreEventRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        $event = Event::create($request->validated());

        return redirect()->route('events.show', $event)->with('status', 'Event created. Issue a pass below.');
    }

    /**
     * Display the specified event and its check-in tokens.
     *
     * @param Event $event
     * @return View
     */
    public function show(Event $event): View
    {
        $checkins = $event->checkins()->latest()->get()->map(function ($token) {
            return [
                'id' => $token->id,
                'meta' => $token->meta,
                'single_use' => $token->single_use,
                'expires_at' => $token->expires_at,
                'used_at' => $token->used_at,
                'status' => match (true) {
                    $token->isUsed() && $token->single_use => 'redeemed',
                    $token->isExpired() => 'expired',
                    default => 'pending',
                },
            ];
        });

        return view('events.show', compact('event', 'checkins'));
    }
}
