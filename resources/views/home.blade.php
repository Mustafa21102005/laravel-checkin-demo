@extends('layouts.app')

@section('title', 'Laravel Checkin — Demo')

@section('content')

    {{-- HERO --}}
    <section class="grid md:grid-cols-2 gap-12 items-center py-8">
        <div>
            <p class="font-mono text-xs text-brass tracking-widest uppercase mb-4">
                composer require mustafa-azmi/laravel-checkin
            </p>
            <h1 class="font-display text-5xl leading-[1.05] mb-5">
                Every check-in<br>
                is a <span class="italic text-brass">signed</span><br>
                little document.
            </h1>
            <p class="text-ink2 leading-relaxed mb-8 max-w-md">
                A Laravel package that turns any Eloquent model into something
                people can be issued a pass for — and checked into, once,
                safely, without you writing the hashing, locking, or expiry
                logic yourself.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('events.index') }}"
                    class="px-5 py-2.5 rounded-lg bg-brass text-ink-900 font-medium text-sm flex items-center gap-2 hover:bg-brass-bright transition">
                    <i data-lucide="ticket" class="w-4 h-4"></i> Try it live
                </a>
                <a href="https://github.com/Mustafa21102005/laravel-checkin" target="_blank"
                    class="px-5 py-2.5 rounded-lg border border-line text-sm flex items-center gap-2 hover:border-brass/50 transition">
                    <i data-lucide="book-open" class="w-4 h-4"></i> Read the docs
                </a>
            </div>
        </div>

        {{-- Signature element: the badge/ticket card --}}
        <div class="relative mx-auto w-full max-w-sm">
            <div
                class="bg-paper text-ink-900 rounded-2xl shadow-2xl shadow-black/40 overflow-hidden rotate-2 hover:rotate-0 transition-transform duration-500">
                <div class="p-5 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-mono text-[10px] tracking-widest uppercase text-ink-900/50">
                            Access Pass
                        </span>
                        <span
                            class="font-mono text-[10px] tracking-widest uppercase px-2 py-0.5 rounded-full bg-teal/20 text-[#0f766e]">
                            Valid
                        </span>
                    </div>
                    <p class="font-display text-2xl mb-0.5">Laravel Meetup</p>
                    <p class="text-xs text-ink-900/50">Riyadh · General Admission</p>
                </div>

                <div class="relative flex items-center">
                    <span class="notch -ml-3"></span>
                    <div class="flex-1 perforated-h"></div>
                    <span class="notch -mr-3"></span>
                </div>

                <div class="p-5 pt-4 flex items-center gap-4">
                    <div class="w-20 h-20 bg-ink-900 rounded-lg grid grid-cols-5 grid-rows-5 gap-0.5 p-2 shrink-0">
                        @for ($i = 0; $i < 25; $i++)
                            <span class="rounded-sm {{ rand(0, 1) ? 'bg-paper' : 'bg-transparent' }}"></span>
                        @endfor
                    </div>
                    <div class="min-w-0">
                        <p class="font-mono text-[11px] text-ink-900/40 mb-1">TOKEN</p>
                        <p class="font-mono text-xs truncate">a1f9…c204e7b8</p>
                        <p class="font-mono text-[11px] text-ink-900/40 mt-2">EXPIRES IN</p>
                        <p class="font-mono text-xs">9:47</p>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-full h-full bg-surface2 rounded-2xl -z-10 border border-line">
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-16 border-t border-line/60">
        <div class="mb-10">
            <p class="font-mono text-xs text-brass tracking-widest uppercase mb-2">What you get</p>
            <h2 class="font-display text-3xl">Every feature the package ships with.</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-brass/15 text-brass flex items-center justify-center mb-3">
                    <i data-lucide="key-round" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">HMAC-hashed tokens</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    The raw token is shown to you once and never stored. Only its HMAC hash lives in the database — a full
                    DB leak can't be used to forge or replay a check-in.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-teal/15 text-teal flex items-center justify-center mb-3">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Race-condition safe</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    The Redemption runs inside a locked database transaction. Two people scanning the same single-use code
                    at the same instant — only one ever succeeds.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-amber/15 text-amber flex items-center justify-center mb-3">
                    <i data-lucide="timer" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Configurable expiry</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    Every token carries its own expiry. Set a global default in config, or override it per-token when you
                    generate one.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-coral/15 text-coral flex items-center justify-center mb-3">
                    <i data-lucide="repeat" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Single-use or reusable</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    Same package, two patterns: a one-time event ticket, or a
                    reusable gym-door pass that works every visit until it expires. Configurable per token.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-brass/15 text-brass flex items-center justify-center mb-3">
                    <i data-lucide="git-branch" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Attaches to any model</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    One polymorphic table, one trait — <code class="font-mono text-xs text-brass">use HasCheckins</code> —
                    and any Eloquent model becomes
                    checkinable. Event, ClassSession, GymVisit, whatever you have.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-teal/15 text-teal flex items-center justify-center mb-3">
                    <i data-lucide="split" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Three specific exceptions</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    <code class="font-mono text-xs">TokenNotFoundException</code>,
                    <code class="font-mono text-xs">TokenExpiredException</code>, <code
                        class="font-mono text-xs">TokenAlreadyUsedException</code> — handle each outcome differently instead
                    of parsing a message string.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-amber/15 text-amber flex items-center justify-center mb-3">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Preview without consuming</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    <code class="font-mono text-xs text-amber">validate()</code>
                    runs every check redemption does, but doesn't mark the token used — good for a confirmation screen
                    before staff commit.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-coral/15 text-coral flex items-center justify-center mb-3">
                    <i data-lucide="tag" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">Arbitrary metadata</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    Attach any array to a token when generating it — attendee name,
                    gate number, device ID — and read it back at redemption time.
                </p>
            </div>

            <div class="bg-surface border border-line rounded-xl p-5">
                <div class="w-9 h-9 rounded-lg bg-brass/15 text-brass flex items-center justify-center mb-3">
                    <i data-lucide="qr-code" class="w-4 h-4"></i>
                </div>
                <h3 class="font-medium mb-1.5">QR-renderer agnostic</h3>
                <p class="text-sm text-ink2 leading-relaxed">
                    The package hands you a signed payload string. Render it with
                    any QR library, a barcode, or don't — send it as a link. Your choice, not a bundled dependency.
                </p>
            </div>

        </div>
    </section>

    {{-- CODE PREVIEW --}}
    <section class="py-16 border-t border-line/60 grid md:grid-cols-2 gap-8 items-start">
        <div>
            <p class="font-mono text-xs text-brass tracking-widest uppercase mb-2">Two calls</p>
            <h2 class="font-display text-2xl mb-4">Issue a pass. Redeem a pass.</h2>
            <p class="text-sm text-ink2 leading-relaxed mb-6">
                That's the entire mental model. Everything else — the hashing,
                the locking, the expiry math — happens inside those two calls
                so you don't have to think about it.
            </p>
            <div class="flex items-center gap-2 text-xs text-ink2">
                <i data-lucide="flask-conical" class="w-3.5 h-3.5 text-teal"></i>
                Verified with automated tests across PHP 8.2–8.4 and Laravel 10–13
            </div>
        </div>

        <div class="bg-surface2 border border-line rounded-xl overflow-hidden">
            <div class="flex items-center gap-1.5 px-4 py-3 border-b border-line">
                <span class="w-2.5 h-2.5 rounded-full bg-coral/60"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber/60"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-teal/60"></span>
            </div>
            <pre class="p-4 text-xs font-mono leading-relaxed overflow-x-auto"><code><span class="text-ink2">// Issue</span>
<span class="text-brass">$pass</span> = <span class="text-paper">$event</span>-&gt;<span class="text-teal">generateCheckinToken</span>(
    <span class="text-ink2">user:</span> <span class="text-paper">$attendee</span>
);

<span class="text-ink2">// Redeem, at the door</span>
<span class="text-brass">$token</span> = <span class="text-teal">Checkin</span>::<span class="text-teal">redeem</span>(<span class="text-paper">$scanned</span>);</code></pre>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="py-16 border-t border-line/60 text-center">
        <h2 class="font-display text-2xl mb-3">See every state, not just the docs.</h2>
        <p class="text-sm text-ink2 mb-6 max-w-md mx-auto">
            Create an event, issue a real pass, and redeem it at the desk —
            including the expired, duplicate, and invalid states.
        </p>
        <a href="{{ route('events.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-brass text-ink-900 font-medium text-sm hover:bg-brass-bright transition">
            <i data-lucide="plus" class="w-4 h-4"></i> Create your first event
        </a>
    </section>

@endsection
