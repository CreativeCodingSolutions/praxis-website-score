<?php
// app/Modules/Stripe/Module.php

namespace App\Modules\Stripe;

class Module
{
    public static function isEnabled(): bool
    {
        return env('FEATURE_STRIPE', false);
    }

    public static function boot()
    {
        if (!self::isEnabled()) return;
        // Stripe-specific boot logic
    }
}
