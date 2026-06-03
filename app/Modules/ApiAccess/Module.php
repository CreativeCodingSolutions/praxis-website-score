<?php

namespace App\Modules\ApiAccess;

class Module
{
    public static string $name = 'ApiAccess';
    public static string $description = 'API key management — generate and revoke API keys';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_API_ACCESS', false);
    }
}
