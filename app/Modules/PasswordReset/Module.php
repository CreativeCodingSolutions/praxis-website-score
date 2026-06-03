<?php
// app/Modules/PasswordReset/Module.php

namespace App\Modules\PasswordReset;

class Module
{
    public static function isEnabled(): bool
    {
        return env('FEATURE_PASSWORDRESET', false);
    }

    public static function boot()
    {
        if (!self::isEnabled()) return;
    }
}
