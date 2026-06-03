<?php

namespace App\Modules\LeadCapture;

class Module
{
    public static string $name = 'LeadCapture';
    public static string $description = 'Besucher-Lead-Capture — Formulare für kostenloses Website-Scoring, Lead-Verwaltung';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_LEAD_CAPTURE', false);
    }
}
