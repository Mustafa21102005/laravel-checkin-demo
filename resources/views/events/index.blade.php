@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="font-mono text-xs text-brass tracking-widest uppercase mb-1">Registry</p>
            <h1 class="font-display text-3xl">Events</h1>
        </div>
        <a href="{{ route('events.create') }}"
            class="px-4 py-2 rounded-lg bg-brass text-ink-900 text-sm font-medium flex items-center gap-1.5 hover:bg-brass-bright transition">
            <i data-lucide="plus" class="w-4 h-4"></i> New event
        </a>
    </div>

    @if ($events->isEmpty())
        <div class="text-center py-20 border border-dashed border-line rounded-2xl">
            <i data-lucide="ticket" class="w-8 h-8 text-ink2 mx-auto mb-3"></i>
            <p class="text-ink2 text-sm mb-4">No events yet.</p>
            <a href="{{ route('events.create') }}" class="text-brass text-sm hover:underline">
                Create your first one →
            </a>
        </div>
    @else
        <div class="grid gap-3">
            @foreach ($events as $event)
                <a href="{{ route('events.show', $event) }}"
                    class="group flex items-center justify-between bg-surface border border-line rounded-xl p-5 hover:border-brass/40 transition">
                    <div class="flex items-center gap-4">
                        <span
                            class="w-11 h-11 rounded-lg bg-ink-800 border border-line flex items-center justify-center text-brass shrink-0">
                            <i data-lucide="{{ $event->single_use ? 'ticket' : 'badge-check' }}" class="w-5 h-5"></i>
                        </span>
                        <div>
                            <p class="font-medium">{{ $event->name }}</p>
                            @if ($event->description)
                                <p class="text-sm text-ink2 mt-0.5">{{ $event->description }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right shrink-0 ml-4">
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-mono
                            {{ $event->single_use ? 'bg-brass/15 text-brass' : 'bg-teal/15 text-teal' }}">
                            {{ $event->single_use ? 'single-use' : 'reusable' }}
                        </span>
                        <p class="text-xs text-ink2 mt-1.5">{{ $event->checkins_count }} issued</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection
