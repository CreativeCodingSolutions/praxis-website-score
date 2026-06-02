<?php
// app/Modules/EmailVerification/Module.php

namespace App\Modules\EmailVerification;

class Module
{
    public static function isEnabled(): bool
    {
        return env('FEATURE_EMAILVERIFICATION', false);
    }

    public static function boot()
    {
        if (!self::isEnabled()) return;
    }
}
