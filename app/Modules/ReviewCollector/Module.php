<?php

namespace App\Modules\ReviewCollector;

class Module
{
    public static string $name = 'ReviewCollector';
    public static string $description = 'Review-Link Generator, Review-Liste & Antwort-Management für Praxis-Websites';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_REVIEW_COLLECTOR', false);
    }

    public static function boot(): void
    {
        if (!self::isEnabled()) return;
        // ReviewCollector-specific boot logic
    }
}
