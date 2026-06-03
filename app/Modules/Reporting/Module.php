<?php

namespace App\Modules\Reporting;

class Module
{
    public static string $name = 'Reporting';
    public static string $description = 'PDF-Reports und Auswertungen — generiert detaillierte Website-Analyse-Reports';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_REPORTING', false);
    }
}
