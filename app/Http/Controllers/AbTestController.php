<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbTestController extends Controller
{
    /**
     * A/B Test: Sommer-Schwung Landing Page
     */
    public function index(Request $request)
    {
        $variant = $request->cookie('pws_ab_variant');

        if (!$variant) {
            $rand = mt_rand(1, 100);
            if ($rand <= 33) {
                $variant = 'control';
            } elseif ($rand <= 66) {
                $variant = 'sommer';
            } else {
                $variant = 'dringlichkeit';
            }
        }

        $content = $this->getVariantContent($variant);

        $response = response()->view('ab.index', [
            'variant' => $variant,
            'hero_headline' => $content['headline'],
            'hero_subheadline' => $content['subheadline'],
            'cta_text' => $content['cta_text'],
            'cta_url' => $content['cta_url'],
            'test_name' => 'pws_sommer_schwung_2026',
        ]);

        $response->withCookie(cookie('pws_ab_variant', $variant, 43200));
        return $response;
    }

    private function getVariantContent(string $variant): array
    {
        $variants = [
            'control' => [
                'headline' => 'Ihre Praxis-Website wird bewertet',
                'subheadline' => 'Kostenloser Score in 60 Sekunden',
                'cta_text' => 'Jetzt Website prüfen',
                'cta_url' => '#hero-form',
            ],
            'sommer' => [
                'headline' => 'Warum Juli der beste Monat für Ihre Praxis-Website ist',
                'subheadline' => 'Praxen, die jetzt optimieren, gewinnen die Herbst-Patienten',
                'cta_text' => 'Herbst-Vorbereitung starten →',
                'cta_url' => '#hero-form',
            ],
            'dringlichkeit' => [
                'headline' => 'Schlafen Ihre Patienten im Sommer? Ihre Website auch?',
                'subheadline' => 'Google indexiert jetzt für den Herbst-Boom. Prüfen Sie Ihren Score.',
                'cta_text' => 'Sofort prüfen — Herbst-Patienten sichern',
                'cta_url' => '#hero-form',
            ],
        ];
        return $variants[$variant] ?? $variants['control'];
    }

    public function trackClick(Request $request)
    {
        $variant = $request->cookie('pws_ab_variant') ?: 'unknown';
        $this->trackAbEvent('cta_click', $variant, $request);
        return response()->json(['status' => 'ok']);
    }

    public function trackConversion(Request $request)
    {
        $variant = $request->cookie('pws_ab_variant') ?: 'unknown';
        $this->trackAbEvent('conversion', $variant, $request);
        return response()->json(['status' => 'ok']);
    }

    private function trackAbEvent(string $event, string $variant, Request $request)
    {
        $logPath = storage_path('logs/ab_test_' . date('Y-m-d') . '.jsonl');
        $data = [
            'timestamp' => now()->toIso8601String(),
            'event' => $event,
            'variant' => $variant,
            'test' => 'pws_sommer_schwung_2026',
            'ip_hash' => md5($request->ip() . config('app.key')),
        ];
        @file_put_contents($logPath, json_encode($data) . "\n", FILE_APPEND | LOCK_EX);
    }

    public function dashboard()
    {
        $logFiles = glob(storage_path('logs/ab_test_*.jsonl'));
        $stats = [];
        foreach ($logFiles as $file) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $data = json_decode($line, true);
                if (!$data) continue;
                $key = ($data['test'] ?? 'unknown') . '_' . ($data['variant'] ?? 'unknown');
                if (!isset($stats[$key])) {
                    $stats[$key] = ['test' => $data['test'] ?? '', 'variant' => $data['variant'] ?? '', 'page_views' => 0, 'cta_clicks' => 0, 'conversions' => 0];
                }
                if (($data['event'] ?? '') === 'page_view') $stats[$key]['page_views']++;
                if (($data['event'] ?? '') === 'cta_click') $stats[$key]['cta_clicks']++;
                if (($data['event'] ?? '') === 'conversion') $stats[$key]['conversions']++;
            }
        }
        foreach ($stats as &$stat) {
            $stat['ctr'] = $stat['page_views'] > 0 ? round(($stat['cta_clicks'] / $stat['page_views']) * 100, 2) : 0;
            $stat['cvr'] = $stat['page_views'] > 0 ? round(($stat['conversions'] / $stat['page_views']) * 100, 2) : 0;
        }
        return view('ab.dashboard', ['stats' => $stats]);
    }
}
