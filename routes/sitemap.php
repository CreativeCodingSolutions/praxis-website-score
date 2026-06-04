<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/sitemap.xml', function () {
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    $pages = [
        ['url' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['url' => '/pricing', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['url' => '/blog', 'priority' => '0.7', 'changefreq' => 'weekly'],
        ['url' => '/impressum', 'priority' => '0.1', 'changefreq' => 'yearly'],
        ['url' => '/datenschutz', 'priority' => '0.1', 'changefreq' => 'yearly'],
        ['url' => '/agb', 'priority' => '0.1', 'changefreq' => 'yearly'],
    ];

    $baseUrl = config('app.url');

    foreach ($pages as $page) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$baseUrl}{$page['url']}</loc>\n";
        $xml .= "    <priority>{$page['priority']}</priority>\n";
        $xml .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
});
