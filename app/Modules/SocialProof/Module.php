<?php

namespace App\Modules\SocialProof;

class Module
{
    public static function name(): string
    {
        return 'SocialProof';
    }

    public static function enabled(): bool
    {
        return env('FEATURE_SOCIAL_PROOF', false);
    }
}
