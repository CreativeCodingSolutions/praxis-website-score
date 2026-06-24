<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Notifications\LeadVerificationEmail;
use Illuminate\Http\Request;

class LeadVerificationController extends Controller
{
    /**
     * Show the verification notice (lead has not verified yet)
     */
    public function show(Request $request)
    {
        $lead = $this->resolveLead($request);

        if (!$lead) {
            return redirect()->route('landing')->with('error', 'Kein Verifizierungsantrag gefunden.');
        }

        if ($lead->isVerified()) {
            return redirect()->route('guest.score.show', $lead->guestReport->uuid)
                ->with('success', 'Email bereits verifiziert.');
        }

        return view('auth.verify-lead', ['lead' => $lead]);
    }

    /**
     * Verify the lead's email via signed link
     */
    public function verify(Request $request, string $id, string $hash)
    {
        $lead = Lead::where('id', $id)
            ->where('verification_token', $hash)
            ->first();

        if (!$lead) {
            abort(404, 'Verifizierungslink ungültig.');
        }

        if ($lead->isVerified()) {
            return redirect()->route('guest.score.show', $lead->guestReport->uuid)
                ->with('success', 'Email bereits verifiziert.');
        }

        $lead->markAsVerified();

        // Store unlocked session
        if ($lead->guestReport) {
            session()->put('guest_report_unlocked_' . $lead->guestReport->uuid, true);
        }

        $redirectUrl = $lead->guestReport
            ? route('guest.score.show', $lead->guestReport->uuid)
            : route('landing');

        return redirect($redirectUrl)
            ->with('success', 'Email erfolgreich verifiziert! Vielen Dank für Ihre Bestätigung.');
    }

    /**
     * Resend the verification email
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $lead = Lead::where('email', $request->input('email'))
            ->whereNull('email_verified_at')
            ->whereNotNull('verification_token')
            ->first();

        if (!$lead) {
            return back()->with('error', 'Kein ausstehender Verifizierungsantrag für diese Email-Adresse gefunden.');
        }

        // Rate limit: only resend if last attempt was more than 5 minutes ago
        if ($lead->updated_at->gt(now()->subMinutes(5))) {
            return back()->with('error', 'Bitte warten Sie 5 Minuten, bevor Sie einen neuen Link anfordern.');
        }

        $token = $lead->generateVerificationToken();
        $lead->notify(new LeadVerificationEmail($token));

        return back()->with('success', 'Verifizierungslink erneut gesendet. Bitte prüfen Sie Ihren Posteingang.');
    }

    private function resolveLead(Request $request): ?Lead
    {
        // Try to find by session or query parameter
        $leadId = $request->query('lead_id');

        if ($leadId) {
            return Lead::find($leadId);
        }

        // Fallback: find most recent unverified lead by IP (last 24h)
        return Lead::where('ip_address', $request->ip())
            ->whereNull('email_verified_at')
            ->whereNotNull('verification_token')
            ->where('created_at', '>=', now()->subDay())
            ->latest()
            ->first();
    }
}
