<?php

namespace App\Http\Controllers;

use App\Models\GuestReport;
use App\Models\Lead;
use App\Services\WebsiteScoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestScoreController extends Controller
{
    /**
     * Show the guest score result (score displayed, email gate for full report)
     */
    public function show(string $uuid)
    {
        $report = GuestReport::where('uuid', $uuid)->firstOrFail();
        $data = [
            'url' => $report->url,
            'domain' => $report->domain,
            'overall_score' => $report->overall_score,
            'categories' => $report->category_scores,
            'recommendations' => $report->recommendations,
            'industry' => $report->industry,
            'crawled_at' => $report->created_at->toDateTimeString(),
        ];

        // If user has unlocked (submitted email), show full report
        $unlocked = session()->has('guest_report_unlocked_' . $uuid);

        return view('guest.show', compact('data', 'report', 'unlocked', 'uuid'));
    }

    /**
     * Analyze a website without login — show score immediately
     */
    public function analyze(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:500',
            'industry' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $url = $this->normalizeUrl($request->input('url'));
        $industry = $request->input('industry', 'general');

        $service = new WebsiteScoreService();
        $result = $service->analyze($url, $industry);

        if (isset($result['error']) && $result['overall_score'] === 0) {
            return back()->with('error', 'Website nicht erreichbar. Bitte prüfen Sie die URL.');
        }

        // Save as guest report
        $report = GuestReport::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'url' => $result['url'],
            'domain' => $result['domain'] ?? parse_url($url, PHP_URL_HOST),
            'industry' => $result['industry'],
            'overall_score' => $result['overall_score'],
            'category_scores' => $result['categories'],
            'recommendations' => $result['recommendations'],
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('guest.score.show', $report->uuid);
    }

    /**
     * Capture email for full report access
     */
    public function captureEmail(Request $request, string $uuid)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
            'consent' => 'required|accepted',
        ], [
            'consent.accepted' => 'Bitte akzeptieren Sie die Datenschutzerklärung, um fortzufahren.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $report = GuestReport::where('uuid', $uuid)->firstOrFail();

        // Save lead with pws_landing source
        Lead::create([
            'guest_report_id' => $report->id,
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'ip_address' => $request->ip(),
            'consent_given' => true,
            'consent_text' => 'Datenschutzerklärung akzeptiert am ' . now()->format('d.m.Y H:i'),
            'source' => 'pws_landing',
        ]);

        // Mark as unlocked in session
        session()->put('guest_report_unlocked_' . $uuid, true);

        // Increment lead count on report
        $report->increment('lead_captured');

        return redirect()->route('guest.score.show', $uuid)
            ->with('success', 'Vielen Dank! Hier ist Ihr detaillierter Report.');
    }

    private function normalizeUrl(string $url): string
    {
        $url = trim($url);
        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://' . $url;
        }
        return $url;
    }
}
