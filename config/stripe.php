<?php
return [
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
        'prices' => [
            'pro' => env('STRIPE_PRICE_PRO'),
            'business' => env('STRIPE_PRICE_BUSINESS'),
        ],
    ],
];
