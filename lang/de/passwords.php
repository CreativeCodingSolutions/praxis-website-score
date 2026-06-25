<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines (German / DSGVO-compliant)
    |--------------------------------------------------------------------------
    |
    | DSGVO/GDPR: The "sent" message is intentionally identical regardless
    | of whether the email exists. This prevents user enumeration attacks.
    |
    */

    'reset' => 'Passwort zurücksetzen',
    'sent' => 'Falls ein Account mit dieser Email existiert, wurde ein Link zum Zurücksetzen gesendet.',
    'throttled' => 'Bitte warten Sie, bevor Sie es erneut versuchen.',
    'token' => 'Der Link ist ungültig oder abgelaufen.',
    'user' => '', // Intentionally empty — DSGVO: never reveal if email exists

];
