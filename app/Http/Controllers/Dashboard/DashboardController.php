<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Subscription;
use App\Services\PdfReportService;
use App\Services\WebsiteScoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard-Übersicht.
     */
    public function index()
    {
        $user = Auth::user();
        $reports = $user->reports()->latest()->take(10)->get();
        $subscription = $user->subscription;

        $stats = [
            'total_reports' => $user->reports()->count(),
            'avg_score' => $user->reports()->avg('overall_score') ?? 0,
            'this_month' => $user->reports()->whereMonth('created_at', now()->month)->count(),
            'plan' => $subscription->plan_label ?? 'Free',
            'remaining' => $user->reports_remaining,
        ];

        return view('dashboard.index', compact('reports', 'stats', 'subscription'));
    }

    /**
     * Formular für neuen Check.
     */
    public function showCheckForm()
    {
        $user = Auth::user();
        if (!$user->canCreateReport()) {
            return redirect('/dashboard')->with('error', 'Dein Limit ist erreicht. Bitte upgrade deinen Plan.');
        }
        return view('dashboard.check');
    }

    /**
     * Neuen Check durchführen.
     */
    public function runCheck(Request $request, WebsiteScoreService $scoreService)
    {
        $user = Auth::user();

        if (!$user->canCreateReport()) {
            return redirect('/dashboard')->with('error', 'Dein Limit ist erreicht. Bitte upgrade deinen Plan.');
        }

        $request->validate([
            'url' => 'required|url|max:500',
            'industry' => ['nullable', Rule::in([
                'psychotherapeut', 'arzt', 'heilpraktiker', 'coach',
                'zahnarzt', 'physiotherapeut', 'ernaehrungsberater', 'general'
            ])],
        ], [
            'url.required' => 'Bitte gib eine URL ein.',
            'url.url' => 'Bitte gib eine gültige URL ein (z.B. https://example.de).',
        ]);

        $result = $scoreService->analyze($request->input('url'));

        if (!$result['success']) {
            return back()->withInput()->with('error', $result['error']);
        }

        // Branche überschreiben wenn manuell gewählt
        if ($request->filled('industry')) {
            $result['industry'] = $request->input('industry');
        }

        // Report speichern
        $report = Report::create([
            'user_id' => $user->id,
            'url' => $result['url'],
            'domain' => $result['domain'],
            'industry' => $result['industry'],
            'overall_score' => $result['overall_score'],
            'category_scores' => $result['categories'],
            'recommendations' => $result['recommendations'],
            'is_public' => false,
        ]);

        // Subscription-Usage erhöhen
        $subscription = $user->subscription;
        if ($subscription) {
            $subscription->incrementUsage();
        }

        return redirect()->route('dashboard.report', $report)
            ->with('success', 'Analyse erfolgreich! Hier ist dein Bericht.');
    }

    /**
     * Einzelnen Report anzeigen.
     */
    public function showReport(Report $report)
    {
        $this->authorize('view', $report);
        return view('dashboard.report', compact('report'));
    }

    /**
     * PDF generieren und herunterladen.
     */
    public function downloadPdf(Report $report, PdfReportService $pdfService)
    {
        $this->authorize('view', $report);

        // Nur für bezahlte Pläne
        if (!Auth::user()->hasPaidPlan()) {
            return redirect()->route('pricing')
                ->with('error', 'PDF-Export ist nur im Pro- oder Business-Plan verfügbar.');
        }

        // PDF generieren wenn nicht vorhanden
        if (!$report->pdfExists()) {
            $scoreData = [
                'url' => $report->url,
                'domain' => $report->domain,
                'overall_score' => $report->overall_score,
                'categories' => $report->category_scores,
                'recommendations' => $report->recommendations,
                'industry' => $report->industry,
                'crawled_at' => $report->created_at->format('Y-m-d H:i:s'),
            ];

            $pdfPath = $pdfService->generate($scoreData);
            $report->update(['pdf_path' => $pdfPath]);
        }

        // Download
        $filename = "website-score-{$report->domain}-{$report->created_at->format('Y-m-d')}.pdf";
        return Storage::download($report->pdf_path, $filename);
    }

    /**
     * Alle Reports auflisten.
     */
    public function reportsList(Request $request)
    {
        $user = Auth::user();
        $reports = $user->reports()
            ->latest()
            ->paginate(20);

        return view('dashboard.reports', compact('reports'));
    }

    /**
     * Report löschen.
     */
    public function deleteReport(Report $report)
    {
        $this->authorize('delete', $report);

        // PDF löschen wenn vorhanden
        if ($report->pdfExists()) {
            Storage::delete($report->pdf_path);
        }

        $report->delete();

        return redirect()->route('dashboard.reports')
            ->with('success', 'Bericht wurde gelöscht.');
    }
}
