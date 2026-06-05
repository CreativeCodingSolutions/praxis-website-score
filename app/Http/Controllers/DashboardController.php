<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lead;
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
        $recentEvaluations = Report::where('user_id', $userId)->latest()->take(5)->get();
        $stats = [
            'total' => Report::where('user_id', $userId)->count(),
            'avg_score' => Report::where('user_id', $userId)->avg('overall_score') ?? 0,
            'pro' => Report::where('user_id', $userId)->where('overall_score', '>=', 80)->count(),
            'user' => Auth::user(),
        ];

        // Module status for dashboard widget
        $modules = [
            [
                'name' => 'Affiliate',
                'description' => 'Empfehlungsprogramm',
                'icon' => 'fa-handshake',
                'enabled' => env('FEATURE_AFFILIATE', false),
            ],
            [
                'name' => 'API Access',
                'description' => 'API-Schlüssel verwalten',
                'icon' => 'fa-key',
                'enabled' => env('FEATURE_API_ACCESS', false),
            ],
            [
                'name' => 'Team Management',
                'description' => 'Team & Rollen',
                'icon' => 'fa-users',
                'enabled' => env('FEATURE_TEAM_MANAGEMENT', false),
            ],
            [
                'name' => 'Reporting',
                'description' => 'PDF-Reports & Auswertungen',
                'icon' => 'fa-file-pdf',
                'enabled' => env('FEATURE_REPORTING', false),
            ],
            [
                'name' => 'White-Label',
                'description' => 'Branding & Domain',
                'icon' => 'fa-palette',
                'enabled' => env('FEATURE_WHITE_LABEL', false),
            ],
            [
                'name' => 'Stripe',
                'description' => 'Zahlungen & Abos',
                'icon' => 'fa-credit-card',
                'enabled' => env('FEATURE_STRIPE', false),
            ],
            [
                'name' => 'Email Verification',
                'description' => 'E-Mail-Bestätigung',
                'icon' => 'fa-envelope-circle-check',
                'enabled' => env('FEATURE_EMAIL_VERIFICATION', false),
            ],
            [
                'name' => 'Password Reset',
                'description' => 'Passwort zurücksetzen',
                'icon' => 'fa-lock',
                'enabled' => env('FEATURE_PASSWORD_RESET', false),
            ],
            [
                'name' => 'Lead Capture',
                'description' => 'Besucher-Lead-Capture',
                'icon' => 'fa-magnet',
                'enabled' => env('FEATURE_LEAD_CAPTURE', false),
            ],
            [
                'name' => 'Social Proof',
                'description' => 'Social Proof Widgets',
                'icon' => 'fa-shield-halved',
                'enabled' => env('FEATURE_SOCIAL_PROOF', false),
            ],
            [
                'name' => 'Review Collector',
                'description' => 'Review-Links & Bewertungen',
                'icon' => 'fa-star',
                'enabled' => env('FEATURE_REVIEW_COLLECTOR', false),
            ],
            [
                'name' => 'Appointment Booking',
                'description' => 'Online-Terminbuchung',
                'icon' => 'fa-calendar-check',
                'enabled' => env('FEATURE_APPOINTMENT_BOOKING', false),
            ],
        ];

        return view('dashboard.index', compact('reports', 'stats', 'modules', 'recentEvaluations'));
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

    /**
     * Leads admin overview
     */
    public function leads()
    {
        $leads = Lead::with('guestReport')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => Lead::count(),
            'this_week' => Lead::where('created_at', '>=', now()->subWeek())->count(),
            'with_report' => Lead::whereNotNull('guest_report_id')->count(),
            'avg_score' => Lead::whereNotNull('guest_report_id')
                ->join('guest_reports', 'leads.guest_report_id', '=', 'guest_reports.id')
                ->avg('guest_reports.overall_score') ?? 0,
        ];

        return view('dashboard.leads', compact('leads', 'stats'));
    }

    /**
     * Delete a lead
     */
    public function deleteLead($id)
    {
        Lead::where('id', $id)->delete();
        return redirect()->route('dashboard.leads')->with('success', 'Lead gelöscht.');
    }
}
