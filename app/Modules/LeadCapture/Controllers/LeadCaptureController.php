<?php

namespace App\Modules\LeadCapture\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\LeadCapture\Models\Lead;
use Illuminate\Http\Request;

class LeadCaptureController extends Controller
{
    public function create()
    {
        return view('modules.leadcapture.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'website_url' => 'required|url|max:500',
        ]);

        $lead = Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'website_url' => $validated['website_url'],
            'score' => null,
            'status' => 'new',
            'source' => 'pws_landing',
            'ip_address' => $request->ip(),
            'consent_given' => $request->has('consent'),
            'consent_text' => 'Datenschutzerklärung akzeptiert am ' . now()->format('d.m.Y H:i'),
        ]);

        // Auto-score the website (simple heuristic)
        $score = $this->calculateScore($lead->website_url);
        $lead->update(['score' => $score, 'status' => 'scored']);

        // Build category breakdown for preview
        $categories = [
            'performance' => ['score' => min(100, $score + rand(-15, 10))],
            'seo' => ['score' => min(100, $score + rand(-10, 15))],
            'mobile' => ['score' => min(100, $score + rand(-12, 8))],
            'content' => ['score' => min(100, $score + rand(-8, 12))],
            'security' => ['score' => min(100, $score + rand(-20, 5))],
            'design' => ['score' => min(100, $score + rand(-10, 10))],
        ];

        return view('modules.leadcapture.result', [
            'website_url' => $lead->website_url,
            'score' => $score,
            'categories' => $categories,
        ]);
    }

    public function thanks()
    {
        return view('modules.leadcapture.thanks');
    }

    private function calculateScore(string $url): int
    {
        $score = 50; // base
        // TLD bonus
        if (str_ends_with(parse_url($url, PHP_URL_HOST) ?? '', '.de')) $score += 5;
        if (str_ends_with(parse_url($url, PHP_URL_HOST) ?? '', '.at')) $score += 5;
        // HTTPS bonus
        if (str_starts_with($url, 'https://')) $score += 10;
        // Length penalty
        if (strlen($url) > 100) $score -= 5;
        // www bonus (SEO signal)
        if (str_contains($url, 'www.')) $score += 3;
        return max(0, min(100, $score + rand(-5, 10)));
    }
}
