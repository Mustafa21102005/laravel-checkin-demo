@extends('layouts.app')

@section('title', $event->name)

@section('content')
    <div class="mb-8">
        <a href="{{ route('events.index') }}" class="text-xs text-ink2 hover:text-paper flex items-center gap-1 mb-4">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Events
        </a>
        <div class="flex items-start justify-between">
            <div>
                <h1 class="font-display text-3xl mb-1">{{ $event->name }}</h1>
                @if ($event->description)
                    <p class="text-ink2 text-sm">{{ $event->description }}</p>
                @endif
            </div>
            <div class="flex gap-2 shrink-0">
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-mono
                    {{ $event->single_use ? 'bg-brass/15 text-brass' : 'bg-teal/15 text-teal' }}">
                    {{ $event->single_use ? 'single-use' : 'reusable' }}
                </span>
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-mono bg-ink-800 text-ink2">
                    <i data-lucide="timer" class="w-3 h-3"></i> {{ $event->ttl_minutes }}m
                </span>
            </div>
        </div>
    </div>

    <div class="bg-surface border border-line rounded-2xl p-6 mb-10">
        <h2 class="font-medium mb-4 flex items-center gap-2"><i data-lucide="stamp" class="w-4 h-4 text-brass"></i> Issue a
            pass</h2>
        <form method="POST" action="{{ route('events.tokens.generate', $event) }}" class="flex gap-3">
            @csrf
            <input type="text" name="attendee_name" placeholder="Attendee name (optional)"
                class="flex-1 bg-ink-800 border border-line rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:border-brass/60 transition">
            <button type="submit"
                class="px-5 py-2.5 rounded-lg bg-brass text-ink-900 text-sm font-medium hover:bg-brass-bright transition whitespace-nowrap flex items-center gap-1.5">
                <i data-lucide="qr-code" class="w-4 h-4"></i> Generate
            </button>
        </form>
    </div>

    <h2 class="font-medium mb-4 flex items-center gap-2"><i data-lucide="list" class="w-4 h-4 text-ink2"></i> History</h2>

    @if ($checkins->isEmpty())
        <p class="text-sm text-ink2">No passes issued yet.</p>
    @else
        <div class="bg-surface border border-line rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-ink-800 text-ink2 text-xs uppercase font-mono tracking-wide">
                    <tr>
                        <th class="text-left px-5 py-3">Attendee</th>
                        <th class="text-left px-5 py-3">Status</th>
                        <th class="text-left px-5 py-3">Expires</th>
                        <th class="text-left px-5 py-3">Used</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line/60">
                    @foreach ($checkins as $checkin)
                        <tr>
                            <td class="px-5 py-3">{{ $checkin['meta']['attendee_name'] ?? '—' }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $badge = match ($checkin['status']) {
                                        'redeemed' => 'bg-teal/15 text-teal',
                                        'expired' => 'bg-coral/15 text-coral',
                                        default => 'bg-amber/15 text-amber',
                                    };
                                @endphp
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-mono {{ $badge }}">
                                    {{ $checkin['status'] }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-ink2 text-xs">
                                {{ $checkin['expires_at']->diffForHumans() }}
                            </td>
                            <td class="px-5 py-3 text-ink2 text-xs">
                                {{ $checkin['used_at']?->diffForHumans() ?? '—' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
