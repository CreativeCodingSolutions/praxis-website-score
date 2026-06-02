<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfReportService
{
    public function generate(array $scoreData): string
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', false);
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);

        $html = $this->buildHtml($scoreData);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'website-score-' . ($scoreData['domain'] ?? 'report') . '-' . date('Y-m-d') . '.pdf';
        $path = storage_path('app/reports/' . $filename);

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $dompdf->output());
        return $path;
    }

    public function stream(array $scoreData): void
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($this->buildHtml($scoreData));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'website-score-' . ($scoreData['domain'] ?? 'report') . '-' . date('Y-m-d') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
    }

    private function buildHtml(array $data): string
    {
        $score = $data['overall_score'] ?? 0;
        $grade = $score >= 90 ? 'A+' : ($score >= 80 ? 'A' : ($score >= 70 ? 'B' : ($score >= 60 ? 'C' : ($score >= 50 ? 'D' : 'F'))));
        $color = $score >= 80 ? '#10B981' : ($score >= 60 ? '#F59E0B' : '#EF4444');
        $url = htmlspecialchars($data['url'] ?? '');
        $domain = htmlspecialchars($data['domain'] ?? '');
        $industry = htmlspecialchars($data['industry'] ?? 'general');
        $date = date('d.m.Y H:i');

        $categories = $data['categories'] ?? [];
        $recommendations = $data['recommendations'] ?? [];

        $catHtml = '';
        $catLabels = [
            'performance' => '⚡ Performance',
            'seo' => '🔍 SEO',
            'mobile' => '📱 Mobile',
            'content' => '📝 Content',
            'security' => '🔒 Sicherheit',
            'design' => '🎨 Design',
        ];
        foreach ($categories as $key => $cat) {
            $catScore = $cat['score'] ?? 0;
            $catColor = $catScore >= 80 ? '#10B981' : ($catScore >= 60 ? '#F59E0B' : '#EF4444');
            $checksHtml = '';
            foreach ($cat['checks'] ?? [] as $check) {
                $icon = $check[0] === '✓' ? '✅' : ($check[0] === '✗' ? '❌' : '⚠️');
                $checksHtml .= '<div style="padding:4px 0;border-bottom:1px solid #f3f4f6;font-size:13px;">' . $icon . ' ' . htmlspecialchars($check[1] ?? '') . '</div>';
            }
            $catHtml .= '
            <div style="margin-bottom:20px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <h3 style="font-size:16px;margin:0;">' . ($catLabels[$key] ?? $key) . '</h3>
                    <span style="font-size:20px;font-weight:bold;color:' . $catColor . ';">' . $catScore . '/100</span>
                </div>
                <div style="background:#f3f4f6;border-radius:8px;height:8px;overflow:hidden;">
                    <div style="background:' . $catColor . ';width:' . $catScore . '%;height:100%;border-radius:8px;"></div>
                </div>
                <div style="margin-top:8px;">' . $checksHtml . '</div>
            </div>';
        }

        $recsHtml = '';
        foreach ($recommendations as $i => $rec) {
            $recsHtml .= '<div style="padding:6px 0;border-bottom:1px solid #f3f4f6;font-size:13px;">' . ($i + 1) . '. ' . htmlspecialchars($rec) . '</div>';
        }

        return '<!DOCTYPE html><html><head><meta charset="utf-8"></head><body style="font-family:Helvetica,Arial,sans-serif;color:#1f2937;padding:40px;">
        <div style="text-align:center;margin-bottom:30px;">
            <h1 style="font-size:28px;margin:0 0 10px;">Website Score Report</h1>
            <p style="color:#6b7280;font-size:14px;">' . $domain . ' · ' . $date . '</p>
        </div>

        <div style="text-align:center;margin-bottom:30px;padding:30px;background:' . $color . '10;border-radius:16px;">
            <div style="font-size:72px;font-weight:bold;color:' . $color . ';">' . $score . '</div>
            <div style="font-size:24px;font-weight:bold;color:' . $color . ';">Note: ' . $grade . '</div>
            <div style="color:#6b7280;margin-top:8px;">von 100 Punkten</div>
        </div>

        <h2 style="font-size:20px;margin:30px 0 15px;">📊 Kategorie-Bewertung</h2>
        ' . $catHtml . '

        <h2 style="font-size:20px;margin:30px 0 15px;">💡 Top Empfehlungen</h2>
        <div style="background:#FEF3C7;border-radius:8px;padding:16px;">
            ' . ($recsHtml ?: '<p style="color:#6b7280;">Keine kritischen Empfehlungen — gute Arbeit!</p>') . '
        </div>

        <div style="margin-top:40px;padding-top:20px;border-top:2px solid #e5e7eb;text-align:center;color:#9ca3af;font-size:12px;">
            Erstellt mit Praxis Website Score · ' . $date . '<br>
            <a href="' . $url . '" style="color:#6366f1;">' . $url . '</a>
        </div>
        </body></html>';
    }
}
