<?php

namespace App\Modules\Reporting\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $userId = Auth::id();

        $reports = Report::where('user_id', $userId)
            ->orderBy('overall_score', 'desc')
            ->paginate(15);

        $stats = [
            'total_reports' => Report::where('user_id', $userId)->count(),
            'avg_score' => round(Report::where('user_id', $userId)->avg('overall_score') ?? 0, 1),
            'top_score' => Report::where('user_id', $userId)->max('overall_score') ?? 0,
            'last_report' => Report::where('user_id', $userId)->latest()->first(),
        ];

        $scheduledReports = DB::table('scheduled_reports')
            ->where('user_id', $userId)
            ->get();

        return view('reporting.index', compact('reports', 'stats', 'scheduledReports'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:full,single,comparative',
            'title' => 'required|string|max:255',
        ]);

        $userId = Auth::id();
        $reports = Report::where('user_id', $userId)->latest()->get();

        // Generate HTML report marked as "PDF"
        $html = $this->renderReportHtml($request->title, $request->report_type, $reports);

        // Store the report
        DB::table('generated_reports')->insert([
            'user_id' => $userId,
            'title' => $request->title,
            'type' => $request->report_type,
            'html_content' => $html,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $id = DB::getPdo()->lastInsertId();

        return redirect()->route('reporting.download', $id)
            ->with('success', 'Report generiert.');
    }

    public function download($id)
    {
        $report = DB::table('generated_reports')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$report) {
            abort(404);
        }

        return response($report->html_content)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $report->title . '.pdf"');
    }

    public function scheduled()
    {
        $scheduled = DB::table('scheduled_reports')
            ->where('user_id', Auth::id())
            ->get();
        return view('reporting.scheduled', compact('scheduled'));
    }

    public function storeScheduled(Request $request)
    {
        $request->validate([
            'frequency' => 'required|in:daily,weekly,monthly',
            'email' => 'required|email',
        ]);

        DB::table('scheduled_reports')->insert([
            'user_id' => Auth::id(),
            'frequency' => $request->frequency,
            'email' => $request->email,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Automatischer Report eingerichtet.');
    }

    public function deleteScheduled($id)
    {
        DB::table('scheduled_reports')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();
        return back()->with('success', 'Automatischer Report gelöscht.');
    }

    private function renderReportHtml(string $title, string $type, $reports): string
    {
        $avgScore = $reports->avg('overall_score') ?? 0;
        $totalReports = $reports->count();

        $rows = '';
        foreach ($reports as $r) {
            $scoreColor = $r->overall_score >= 80 ? '#16a34a' : ($r->overall_score >= 60 ? '#ca8a04' : '#dc2626');
            $rows .= "<tr>
                <td style='padding:8px;border:1px solid #ddd;'>{$r->domain}</td>
                <td style='padding:8px;border:1px solid #ddd;text-align:center;color:{$scoreColor};font-weight:bold;'>{$r->overall_score}</td>
                <td style='padding:8px;border:1px solid #ddd;'>{$r->industry}</td>
                <td style='padding:8px;border:1px solid #ddd;'>{$r->created_at->format('d.m.Y')}</td>
            </tr>";
        }

        return <<<HTML
<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>{$title}</title></head>
<body style="font-family:Arial,sans-serif;padding:40px;color:#1f2937;">
    <div style="text-align:center;margin-bottom:40px;border-bottom:3px solid #4f46e5;padding-bottom:20px;">
        <h1 style="color:#4f46e5;margin:0;">Praxis Website Score</h1>
        <h2 style="color:#6b7280;font-weight:normal;margin:8px 0;">{$title}</h2>
        <p style="color:#9ca3af;">Erstellt am: {$reports->first()?->created_at?->format('d.m.Y H:i') ?? date('d.m.Y H:i')} | Typ: {$type}</p>
    </div>

    <div style="display:flex;gap:20px;margin-bottom:30px;">
        <div style="flex:1;background:#f0f9ff;border:1px solid #bae6fd;border-radius:8px;padding:16px;text-align:center;">
            <h3 style="margin:0;color:#0369a1;">{$totalReports}</h3><p style="margin:4px 0 0;color:#6b7280;">Auswertungen</p>
        </div>
        <div style="flex:1;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:16px;text-align:center;">
            <h3 style="margin:0;color:#15803d;">{$avgScore}</h3><p style="margin:4px 0 0;color:#6b7280;">Ø Score</p>
        </div>
        <div style="flex:1;background:#fefce8;border:1px solid #fde68a;border-radius:8px;padding:16px;text-align:center;">
            <h3 style="margin:0;color:#a16207;">{$reports->max('overall_score')}</h3><p style="margin:4px 0 0;color:#6b7280;">Top Score</p>
        </div>
    </div>

    <table style="width:100%;border-collapse:collapse;margin-top:20px;">
        <thead>
            <tr style="background:#4f46e5;color:white;">
                <th style="padding:10px;border:1px solid #ddd;text-align:left;">Domain</th>
                <th style="padding:10px;border:1px solid #ddd;text-align:center;">Score</th>
                <th style="padding:10px;border:1px solid #ddd;text-align:left;">Branche</th>
                <th style="padding:10px;border:1px solid #ddd;text-align:left;">Datum</th>
            </tr>
        </thead>
        <tbody>{$rows}</tbody>
    </table>

    <div style="margin-top:40px;padding-top:20px;border-top:1px solid #e5e7eb;color:#9ca3af;font-size:12px;text-align:center;">
        <p>Generiert von Praxis Website Score — praxiswebsitescore.creativecoding.cloud</p>
        <p>Dieser Report wird als HTML-Simulation bereitgestellt (kein natives PDF).</p>
    </div>
</body>
</html>
HTML;
    }
}
