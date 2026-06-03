<?php

namespace App\Modules\Affiliate;

class Module
{
    public static string $name = 'Affiliate';
    public static string $description = 'Affiliate tracking system — referral codes and dashboard';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_AFFILIATE', false);
    }
}
