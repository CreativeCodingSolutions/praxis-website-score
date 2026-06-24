<?php

namespace App\Modules\LeadCapture\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\LeadCapture\Models\Lead;
use Illuminate\Http\Request;

class LeadAdminController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->paginate(20);
        $stats = [
            'total' => Lead::count(),
            'this_week' => Lead::where('created_at', '>=', now()->subWeek())->count(),
            'new' => Lead::where('status', 'new')->count(),
        ];
        return view('modules.leadcapture.admin.index', compact('leads', 'stats'));
    }

    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return view('modules.leadcapture.admin.show', compact('lead'));
    }

    public function destroy($id)
    {
        Lead::where('id', $id)->delete();
        return redirect()->route('leads.index')->with('success', 'Lead gelöscht.');
    }

    public function score($id)
    {
        $lead = Lead::findOrFail($id);
        // Re-score: nutze die gleiche deterministische Logik
        $score = $this->calculateScore($lead->website_url);
        $lead->update(['score' => $score, 'status' => 'scored']);
        return redirect()->route('leads.show', $lead)->with('success', "Neuer Score: {$score}");
    }

    /**
     * Deterministische Score-Berechnung (LeadCaptureController::calculateScore repliziert).
     */
    private function calculateScore(string $url): int
    {
        $score = 50;

        $host = parse_url($url, PHP_URL_HOST) ?? '';
        $scheme = parse_url($url, PHP_URL_SCHEME) ?? '';

        if (str_ends_with($host, '.de')) $score += 5;
        if (str_ends_with($host, '.at')) $score += 5;
        if (str_ends_with($host, '.ch')) $score += 3;

        if ($scheme === 'https') $score += 10;
        if (strlen($url) > 100) $score -= 5;
        if (str_contains($url, 'www.')) $score += 3;
        if (str_contains($host, '-')) $score -= 3;

        $parts = explode('.', $host);
        if (count($parts) > 3) $score -= 5;

        $domainLength = strlen($parts[0] ?? '');
        if ($domainLength <= 6) $score += 5;
        elseif ($domainLength > 20) $score -= 5;

        $hash = crc32($url);
        $variation = ($hash % 11) - 5;

        return max(0, min(100, $score + $variation));
    }
}
