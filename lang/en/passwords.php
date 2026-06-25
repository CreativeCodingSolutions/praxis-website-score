<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines (English / DSGVO-compliant)
    |--------------------------------------------------------------------------
    |
    | DSGVO/GDPR: The "sent" message is intentionally identical regardless
    | of whether the email exists. This prevents user enumeration attacks.
    |
    */

    'reset' => 'Reset Password',
    'sent' => 'If an account with this email exists, a reset link has been sent.',
    'throttled' => 'Please wait before retrying.',
    'token' => 'This reset link is invalid or has expired.',
    'user' => '', // Intentionally empty — DSGVO: never reveal if email exists

];
