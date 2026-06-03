<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\WebsiteScoreService;
use App\Services\PdfReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $reports = Report::where('user_id', $userId)->latest()->paginate(10);
        $stats = [
            'total' => Report::where('user_id', $userId)->count(),
            'avg_score' => Report::where('user_id', $userId)->avg('overall_score') ?? 0,
            'pro' => Report::where('user_id', $userId)->where('overall_score', '>=', 80)->count(),
            'user' => Auth::user(),
        ];
        return view('dashboard.index', compact('reports', 'stats'));
    }

    public function check(Request $request)
    {
        $user = Auth::user();
        if ($user->reports_used >= $user->reports_limit && $user->plan === 'free') {
            return back()->with('error', 'Free-Limit erreicht. Upgrade auf Pro für mehr Checks.');
        }

        $validated = $request->validate([
            'url' => 'required|url',
            'industry' => 'nullable|string|max:50',
        ]);

        $service = new WebsiteScoreService();
        $result = $service->analyze($validated['url'], $validated['industry'] ?? 'general');

        if (isset($result['error'])) {
            return back()->with('error', $result['error']);
        }

        $report = Report::create([
            'user_id' => $user->id,
            'url' => $result['url'],
            'domain' => $result['domain'] ?? parse_url($validated['url'], PHP_URL_HOST),
            'industry' => $result['industry'],
            'overall_score' => $result['overall_score'],
            'category_scores' => $result['categories'],
            'recommendations' => $result['recommendations'],
        ]);

        $user->increment('reports_used');

        return redirect()->route('dashboard.report', $report)->with('success', 'Analyse abgeschlossen!');
    }

    public function showReport(Report $report)
    {
        $this->authorize('view', $report);
        return view('dashboard.report', ['data' => [
            'url' => $report->url,
            'domain' => $report->domain,
            'overall_score' => $report->overall_score,
            'categories' => $report->category_scores,
            'recommendations' => $report->recommendations,
            'industry' => $report->industry,
            'crawled_at' => $report->created_at->toDateTimeString(),
        ], 'report' => $report]);
    }

    public function downloadPdf(Report $report)
    {
        $this->authorize('view', $report);
        $service = new PdfReportService();
        $data = [
            'url' => $report->url,
            'domain' => $report->domain,
            'overall_score' => $report->overall_score,
            'categories' => $report->category_scores,
            'recommendations' => $report->recommendations,
            'industry' => $report->industry,
            'crawled_at' => $report->created_at->toDateTimeString(),
        ];
        $service->stream($data);
    }

    public function pricing()
    {
        return view('pricing');
    }
}
