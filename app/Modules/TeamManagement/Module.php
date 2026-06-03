<?php

namespace App\Modules\TeamManagement;

class Module
{
    public static string $name = 'TeamManagement';
    public static string $description = 'Team/collaboration features — invite members and manage roles';
    public static string $version = '1.0.0';

    public static function isEnabled(): bool
    {
        return env('FEATURE_TEAM_MANAGEMENT', false);
    }
}
