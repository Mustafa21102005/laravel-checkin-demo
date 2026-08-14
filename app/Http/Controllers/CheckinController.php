<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use MustafaAzmi\Checkin\Exceptions\{TokenAlreadyUsedException, TokenExpiredException, TokenNotFoundException};
use MustafaAzmi\Checkin\Facades\Checkin;

class CheckinController extends Controller
{
    /**
     * Generate a check-in token and QR code for the specified event.
     *
     * @param Request $request
     * @param Event $event
     * @return View
     */
    public function generate(Request $request, Event $event): View
    {
        $validated = $request->validate([
            'attendee_name' => ['nullable', 'string', 'max:255'],
        ]);

        $generated = $event->generateCheckinToken(
            expiresAt: now()->addMinutes($event->ttl_minutes),
            singleUse: $event->single_use,
            meta: array_filter([
                'attendee_name' => $validated['attendee_name'] ?? null,
            ]),
        );

        $qrCode = new QrCode(
            data: $generated->toQrPayload(),
            size: 320,
            margin: 12,
        );

        $qrDataUri = (new PngWriter())
            ->write($qrCode)
            ->getDataUri();

        return view('checkin.generated', [
            'event' => $event,
            'generated' => $generated,
            'qrDataUri' => $qrDataUri,
        ]);
    }

    /**
     * Display the check-in desk.
     *
     * @return View
     */
    public function deskShow(): View
    {
        return view('checkin.desk');
    }

    /**
     * Redeem a check-in token and record the check-in result.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function redeem(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string'],
        ]);

        try {
            $token = Checkin::redeem($validated['code']);

            $eventName = $token->tokenable?->name ?? 'Unknown event';
            $attendee = $token->meta['attendee_name'] ?? null;

            return redirect()->route('checkin.desk')->with('result', [
                'status' => 'success',
                'message' => $attendee
                    ? "{$attendee} checked in — {$eventName}"
                    : "Checked in — {$eventName}",
            ]);
        } catch (TokenNotFoundException $e) {
            return redirect()->route('checkin.desk')->with('result', [
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        } catch (TokenExpiredException $e) {
            return redirect()->route('checkin.desk')->with('result', [
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        } catch (TokenAlreadyUsedException $e) {
            return redirect()->route('checkin.desk')->with('result', [
                'status' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
