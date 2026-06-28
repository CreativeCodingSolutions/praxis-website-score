<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadMagnetsDownload;

class LeadMagnetsController extends Controller
{
    /**
     * PWS Security Checklist Landing Page
     */
    public function securityChecklist()
    {
        return view('lead-magnets.security-checklist');
    }

    /**
     * Process PWS Lead Magnet email capture
     */
    public function capturePwsEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
            'source' => 'nullable|string|in:pws_landing,blog,social',
        ]);

        // Store lead in database/table
        $this->storeLead([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? '',
            'source' => $validated['source'] ?? 'pws_landing',
            'magnet' => 'security_checklist',
            'created_at' => now(),
        ]);

        // Send email with download link
        try {
            Mail::to($validated['email'])->send(new LeadMagnetsDownload('pws_security'));
        } catch (\Exception $e) {
            Log::warning('Lead magnet email failed: ' . $e->getMessage());
        }

        // Track as conversion for A/B test if applicable
        if ($request->hasCookie('pws_ab_variant')) {
            $variant = $request->cookie('pws_ab_variant');
            $logPath = storage_path('logs/ab_test_' . date('Y-m-d') . '.jsonl');
            $data = [
                'timestamp' => now()->toIso8601String(),
                'event' => 'conversion',
                'variant' => $variant,
                'test' => 'pws_sommer_schwung_2026',
                'ip_hash' => md5($request->ip() . config('app.key')),
            ];
            @file_put_contents($logPath, json_encode($data) . "\n", FILE_APPEND | LOCK_EX);
        }

        return redirect()->route('lead-magnets.pws.thanks');
    }

    /**
     * PWS Thank You / Download page
     */
    public function thanks()
    {
        return view('lead-magnets.thanks');
    }

    /**
     * Store lead in simple JSON storage (replace with DB in production)
     */
    private function storeLead(array $data)
    {
        $leadsFile = storage_path('leads/pws_leads.json');
        $dir = dirname($leadsFile);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $existing = [];
        if (file_exists($leadsFile)) {
            $content = file_get_contents($leadsFile);
            $existing = json_decode($content, true) ?: [];
        }

        // Check if email already exists
        $email = $data['email'];
        foreach ($existing as $lead) {
            if (strtolower($lead['email'] ?? '') === strtolower($email)) {
                return; // Duplicate, skip
            }
        }

        $existing[] = $data;
        file_put_contents($leadsFile, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);

        Log::info('New lead captured', ['email' => $data['email'], 'source' => $data['source']]);
    }
}
