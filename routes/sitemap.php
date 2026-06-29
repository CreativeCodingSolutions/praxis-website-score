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
        ['url' => '/blog/lead-recherche-fuer-praxen', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/lead-recherche-deutschland-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/sommer-seo-google-business-profile-patientengewinnung', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/conversion-optimierung-lokale-dienstleister', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/patientenrezensionen-google-business-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/physiotherapie-website-optimieren-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/zahnarzt-website-erstellen-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/sommer-relaunch-checkliste-praxiswebsite-2026', 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['url' => '/blog/sommerferien-checkliste-praxiswebsite-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/lokales-seo-praxen-mehr-patienten-kw33', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/raende-patienten-verliert', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/professionelle-praxis-seiten', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/seo-aerzte-therapeuten', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/praxis-website-relaunch-7-fehler', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/google-business-profile-praxen-2026-checkliste', 'priority' => '0.7', 'changefreq' => 'monthly'],
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
