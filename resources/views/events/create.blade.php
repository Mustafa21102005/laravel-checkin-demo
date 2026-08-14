@extends('layouts.app')

@section('title', 'New Event')

@section('content')
    <div class="max-w-lg mx-auto">
        <p class="font-mono text-xs text-brass tracking-widest uppercase mb-1 text-center">New</p>
        <h1 class="font-display text-3xl mb-8 text-center">Create an event</h1>

        <form method="POST" action="{{ route('events.store') }}"
            class="bg-surface border border-line rounded-2xl p-7 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-2 text-ink2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Laravel Meetup Riyadh"
                    class="w-full bg-ink-800 border border-line rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:border-brass/60 transition">
                @error('name')
                    <p class="text-sm text-coral mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2 text-ink2">
                    Description <span class="text-ink2/60">(optional)</span>
                </label>
                <textarea name="description" rows="2"
                    class="w-full bg-ink-800 border border-line rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:border-brass/60 transition">
                    {{ old('description') }}
                </textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2 text-ink2">Expires after</label>
                    <div class="relative">
                        <input type="number" name="ttl_minutes" value="{{ old('ttl_minutes', 10) }}" min="1"
                            max="1440" required
                            class="w-full bg-ink-800 border border-line rounded-lg pl-3.5 pr-14 py-2.5 text-sm focus:outline-none focus:border-brass/60 transition">
                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs text-ink2">min</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2 text-ink2">Pass type</label>
                    <select name="single_use"
                        class="w-full bg-ink-800 border border-line rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:border-brass/60 transition">
                        <option value="1" selected>Single-use</option>
                        <option value="0">Reusable</option>
                    </select>
                </div>
            </div>

            <p class="text-xs text-ink2 leading-relaxed flex gap-2">
                <i data-lucide="info" class="w-3.5 h-3.5 shrink-0 mt-0.5"></i>
                Single-use passes can only be redeemed once — a second scan is rejected. Reusable passes work repeatedly
                until they expire, like a door badge.
            </p>

            <button type="submit"
                class="w-full bg-brass text-ink-900 font-medium text-sm py-2.5 rounded-lg hover:bg-brass-bright transition flex items-center justify-center gap-2">
                <i data-lucide="ticket" class="w-4 h-4"></i> Create event
            </button>
        </form>
    </div>
@endsection
