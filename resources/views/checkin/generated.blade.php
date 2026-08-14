@extends('layouts.app')

@section('title', 'Pass Issued')

@section('content')
    <div class="max-w-sm mx-auto text-center">
        <p class="font-mono text-xs text-teal tracking-widest uppercase mb-2 flex items-center justify-center gap-1.5">
            <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Pass issued
        </p>
        <h1 class="font-display text-2xl mb-8">{{ $event->name }}</h1>

        {{-- The ticket --}}
        <div class="bg-paper text-ink-900 rounded-2xl shadow-2xl shadow-black/40 overflow-hidden text-left">
            <div class="p-5 pb-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-mono text-[10px] tracking-widest uppercase text-ink-900/50">Access Pass</span>
                    <span
                        class="font-mono text-[10px] tracking-widest uppercase px-2 py-0.5 rounded-full
                        {{ $event->single_use ? 'bg-[#C9974A]/20 text-[#8a6224]' : 'bg-teal/20 text-[#0f766e]' }}">
                        {{ $event->single_use ? 'Single-use' : 'Reusable' }}
                    </span>
                </div>
                <p class="font-display text-xl">{{ $event->name }}</p>
                @if ($generated->model->meta['attendee_name'] ?? null)
                    <p class="text-xs text-ink-900/50 mt-0.5">{{ $generated->model->meta['attendee_name'] }}</p>
                @endif
            </div>

            <div class="relative flex items-center">
                <span class="notch -ml-3"></span>
                <div class="flex-1 perforated-h"></div>
                <span class="notch -mr-3"></span>
            </div>

            <div class="p-5 pt-4">
                <img src="{{ $qrDataUri }}" alt="Check-in QR code"
                    class="w-full rounded-lg mb-4 border border-ink-900/10">
                <p class="font-mono text-[10px] text-ink-900/40 mb-1">EXPIRES</p>
                <p class="font-mono text-xs">{{ $generated->model->expires_at->format('H:i:s') }}
                    ({{ $generated->model->expires_at->diffForHumans() }})</p>
            </div>
        </div>

        <div class="mt-5 bg-surface border border-line rounded-xl p-4 text-left">
            <p class="text-xs text-ink2 mb-2 flex items-center gap-1.5"><i data-lucide="shield-alert"
                    class="w-3.5 h-3.5 text-brass"></i> Raw payload — shown once, never stored:</p>
            <code class="text-xs break-all font-mono text-brass">{{ $generated->toQrPayload() }}</code>
        </div>

        <div class="flex gap-3 mt-6 justify-center">
            <a href="{{ route('events.show', $event) }}"
                class="text-sm px-4 py-2.5 rounded-lg border border-line hover:border-brass/40 transition flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back
            </a>
            <a href="{{ route('checkin.desk') }}"
                class="text-sm px-4 py-2.5 rounded-lg bg-brass text-ink-900 font-medium hover:bg-brass-bright transition flex items-center gap-1.5">
                Check-in desk <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>
@endsection
