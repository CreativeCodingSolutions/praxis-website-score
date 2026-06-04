<?php
// app/Modules/PasswordReset/Module.php

namespace App\Modules\PasswordReset;

class Module
{
    public static function isEnabled(): bool
    {
        return env('FEATURE_PASSWORD_RESET', false);
    }

    public static function boot()
    {
        if (!self::isEnabled()) return;
    }
}
