<?php

namespace App\Modules\WhiteLabel;

class Module
{
    public static string $name = 'WhiteLabel';
    public static string $description = 'White-Label Branding — eigene Domain, Logo und Farben für das Reporting';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_WHITELABEL', false);
    }
}
