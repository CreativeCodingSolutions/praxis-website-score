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

        // Auto-score the website (deterministic heuristic)
        $score = $this->calculateScore($lead->website_url);
        $lead->update(['score' => $score, 'status' => 'scored']);

        // Build category breakdown for preview (deterministic, derived from main score)
        $categories = $this->calculateCategories($score, $lead->website_url);

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

    /**
     * Deterministische Score-Berechnung basierend auf URL-Merkmalen.
     * Gleiche URL = gleiche Score (kein Zufall).
     */
    private function calculateScore(string $url): int
    {
        $score = 50; // Basis

        $host = parse_url($url, PHP_URL_HOST) ?? '';
        $scheme = parse_url($url, PHP_URL_SCHEME) ?? '';

        // TLD-Bonus (deutsche Domains bevorzugt)
        if (str_ends_with($host, '.de')) $score += 5;
        if (str_ends_with($host, '.at')) $score += 5;
        if (str_ends_with($host, '.ch')) $score += 3;

        // HTTPS-Bonus
        if ($scheme === 'https') $score += 10;

        // URL-Länge als Qualitätsindikator
        if (strlen($url) > 100) $score -= 5;

        // www-Präfix (SEO-Signal)
        if (str_contains($url, 'www.')) $score += 3;

        // Bindestriche im Domainnamen (oft Schlagwort-Domains, weniger wertig)
        if (str_contains($host, '-')) $score -= 3;

        // Subdomain-Tiefe (viele Subdomains = weniger professionell)
        $parts = explode('.', $host);
        if (count($parts) > 3) $score -= 5;

        // Konsistente Länge des Domainnamens (kurze Domains sind wertvoller)
        $domainLength = strlen($parts[0] ?? '');
        if ($domainLength <= 6) $score += 5;
        elseif ($domainLength > 20) $score -= 5;

        // Hash-basierte Variation für subtilen Unterschied zwischen URLs
        // (determinismus, aber nicht komplett vorhersehbar für den Nutzer)
        $hash = crc32($url);
        $variation = ($hash % 11) - 5; // -5 bis +5

        return max(0, min(100, $score + $variation));
    }

    /**
     * Kategorie-Scores werden deterministisch aus der Hauptscore abgeleitet.
     */
    private function calculateCategories(int $baseScore, string $url): array
    {
        $hash = crc32($url . 'categories');
        $offsets = [
            'performance' => ($hash % 7) - 3,
            'seo' => (($hash >> 3) % 7) - 3,
            'mobile' => (($hash >> 6) % 7) - 3,
            'content' => (($hash >> 9) % 7) - 3,
            'security' => (($hash >> 12) % 7) - 3,
            'design' => (($hash >> 15) % 7) - 3,
        ];

        $categories = [];
        foreach ($offsets as $key => $offset) {
            $categories[$key] = ['score' => max(0, min(100, $baseScore + $offset))];
        }

        return $categories;
    }
}
