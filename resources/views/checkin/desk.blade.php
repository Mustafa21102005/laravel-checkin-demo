@extends('layouts.app')

@section('title', 'Check-in Desk')

@section('content')
    <p class="font-mono text-xs text-brass tracking-widest uppercase mb-1">Terminal</p>
    <h1 class="font-display text-3xl mb-8">Check-in desk</h1>

    @if (session('result'))
        @php $result = session('result'); @endphp
        <div @class([
            'mb-8 rounded-xl border px-5 py-4 text-sm font-medium flex items-center gap-3',
            'bg-teal/10 border-teal/30 text-teal' => $result['status'] === 'success',
            'bg-amber/10 border-amber/30 text-amber' => $result['status'] === 'warning',
            'bg-coral/10 border-coral/30 text-coral' => $result['status'] === 'error',
        ])>
            <i data-lucide="{{ $result['status'] === 'success' ? 'check-circle-2' : ($result['status'] === 'warning' ? 'alert-triangle' : 'x-circle') }}"
                class="w-5 h-5 shrink-0"></i>
            {{ $result['message'] }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-surface border border-line rounded-2xl p-6">
            <h2 class="font-medium mb-4 flex items-center gap-2">
                <i data-lucide="camera" class="w-4 h-4 text-brass"></i> Scan
            </h2>
            <div id="qr-reader" class="rounded-xl overflow-hidden border border-line"></div>
            <p class="text-xs text-ink2 mt-3 flex items-start gap-1.5">
                <i data-lucide="info" class="w-3.5 h-3.5 shrink-0 mt-0.5"></i>
                Requires camera permission. A scan auto-submits the form on the right.
            </p>
        </div>

        <div class="bg-surface border border-line rounded-2xl p-6">
            <h2 class="font-medium mb-4 flex items-center gap-2">
                <i data-lucide="keyboard" class="w-4 h-4 text-brass"></i>
                Or type it
            </h2>
            <form method="POST" action="{{ route('checkin.redeem') }}" id="redeem-form" class="space-y-3">
                @csrf
                <input type="text" name="code" id="code-input" placeholder="Paste or type the raw token"
                    class="w-full bg-ink-800 border border-line rounded-lg px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:border-brass/60 transition"
                    autofocus>
                <button type="submit"
                    class="w-full bg-brass text-ink-900 text-sm font-medium py-2.5 rounded-lg hover:bg-brass-bright transition flex items-center justify-center gap-1.5">
                    <i data-lucide="scan-line" class="w-4 h-4"></i> Redeem
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-line/60 space-y-2.5">
                <p class="text-xs text-ink2 uppercase tracking-wide font-mono">Try each outcome</p>
                <div class="flex items-start gap-2 text-xs">
                    <span
                        class="w-4 h-4 rounded-full bg-teal/20 text-teal flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="check" class="w-2.5 h-2.5"></i>
                    </span>
                    <span class="text-ink2">
                        Generate a pass, redeem it — <span class="text-teal">success</span>
                    </span>
                </div>
                <div class="flex items-start gap-2 text-xs">
                    <span
                        class="w-4 h-4 rounded-full bg-amber/20 text-amber flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="repeat" class="w-2.5 h-2.5"></i>
                    </span>
                    <span class="text-ink2">
                        Redeem the same single-use code again — <span class="text-amber">already
                            used</span>
                    </span>
                </div>
                <div class="flex items-start gap-2 text-xs">
                    <span
                        class="w-4 h-4 rounded-full bg-coral/20 text-coral flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="x" class="w-2.5 h-2.5"></i>
                    </span>
                    <span class="text-ink2">Type a random string — <span class="text-coral">not found</span></span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const reader = document.getElementById('qr-reader');
            const form = document.getElementById('redeem-form');
            const input = document.getElementById('code-input');

            const scanner = new Html5Qrcode('qr-reader');

            let scanned = false;

            const config = {
                fps: 10,
                qrbox: {
                    width: 300,
                    height: 300
                },
                aspectRatio: 1.0,
                disableFlip: true
            };

            try {
                const cameras = await Html5Qrcode.getCameras();

                if (!cameras.length) {
                    console.error('No camera found.');
                    return;
                }

                // Prefer a rear/back camera.
                const backCamera = cameras.find(camera =>
                    /back|rear|environment/i.test(camera.label)
                );

                const cameraId = backCamera ?
                    backCamera.id :
                    cameras[0].id;

                await scanner.start(
                    cameraId,
                    config,
                    async (decodedText) => {
                            if (scanned) {
                                return;
                            }

                            scanned = true;

                            input.value = decodedText;

                            try {
                                await scanner.stop();
                            } catch (error) {
                                console.warn('Scanner stop error:', error);
                            }

                            form.submit();
                        },
                        () => {
                            // Normal scan failure. Ignore.
                        }
                );

            } catch (error) {
                console.error('QR scanner error:', error);
            }
        });
    </script>
@endsection
