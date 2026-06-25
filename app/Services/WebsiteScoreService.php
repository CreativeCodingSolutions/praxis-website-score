<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WebsiteScoreService
{
    private WebCrawlerService $crawler;

    public function __construct()
    {
        $this->crawler = new WebCrawlerService();
    }

    public function analyze(string $url, string $industry = 'general'): array
    {
        $cacheKey = 'ws_' . md5($url . $industry);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $html = $this->crawler->fetch($url);
        $headers = $this->crawler->getHeaders($url);

        if (!$html) {
            return ['error' => 'Website nicht erreichbar', 'url' => $url, 'overall_score' => 0];
        }

        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        $performance = $this->scorePerformance($url, $headers, $html);
        $seo = $this->scoreSeo($xpath);
        $mobile = $this->scoreMobile($xpath, $html);
        $content = $this->scoreContent($xpath, $industry);
        $security = $this->scoreSecurity($headers);
        $design = $this->scoreDesign($xpath, $html);

        $overall = (int) round(
            ($performance['score'] * 0.15) +
            ($seo['score'] * 0.25) +
            ($mobile['score'] * 0.15) +
            ($content['score'] * 0.20) +
            ($security['score'] * 0.10) +
            ($design['score'] * 0.15)
        );

        $recommendations = $this->buildRecommendations($performance, $seo, $mobile, $content, $security, $design);

        $result = [
            'url' => $url,
            'domain' => parse_url($url, PHP_URL_HOST),
            'overall_score' => min(100, max(0, $overall)),
            'categories' => [
                'performance' => $performance,
                'seo' => $seo,
                'mobile' => $mobile,
                'content' => $content,
                'security' => $security,
                'design' => $design,
            ],
            'recommendations' => $recommendations,
            'industry' => $industry,
            'crawled_at' => now()->toDateTimeString(),
        ];

        Cache::put($cacheKey, $result, 3600);
        return $result;
    }

    private function scorePerformance(string $url, array $headers, string $html): array
    {
        $checks = [];
        $score = 0;

        // Response time via get_headers (already fetched above)
        $start = microtime(true);
        @get_headers($url);
        $responseTime = (microtime(true) - $start) * 1000;
        if ($responseTime < 500) { $score += 25; $checks[] = ['✓', 'Ladezeit unter 500ms (sehr gut)']; }
        elseif ($responseTime < 1000) { $score += 20; $checks[] = ['✓', 'Ladezeit unter 1s (gut)']; }
        elseif ($responseTime < 2000) { $score += 10; $checks[] = ['~', 'Ladezeit 1-2s (verbesserungswürdig)']; }
        else { $checks[] = ['✗', 'Ladezeit über 2s (zu langsam)']; }

        // Gzip
        $encoding = $headers['Content-Encoding'] ?? '';
        if (str_contains($encoding, 'gzip') || str_contains($encoding, 'br')) {
            $score += 25; $checks[] = ['✓', 'Kompression aktiviert (gzip/brotli)'];
        } else {
            $checks[] = ['✗', 'Keine Kompression — gzip aktivieren'];
        }

        // Minified CSS/JS
        if (preg_match('/\.min\.(css|js)/', $html)) {
            $score += 25; $checks[] = ['✓', 'Minified CSS/JS erkannt'];
        } else {
            $checks[] = ['~', 'CSS/JS nicht minimiert — spart Bandbreite'];
        }

        // Image optimization
        preg_match_all('/<img[^>]+>/i', $html, $imgs);
        $totalImgs = count($imgs[0]);
        $imgsWithoutAlt = 0;
        foreach ($imgs[0] ?? [] as $img) {
            if (!preg_match('/alt=["\'][^"\']+["\']/i', $img)) $imgsWithoutAlt++;
        }
        if ($totalImgs === 0) { $score += 25; $checks[] = ['✓', 'Keine Bilder (schnell)']; }
        elseif ($imgsWithoutAlt === 0) { $score += 25; $checks[] = ['✓', "Alle {$totalImgs} Bilder haben Alt-Text"]; }
        elseif ($imgsWithoutAlt < $totalImgs * 0.3) { $score += 15; $checks[] = ['~', "{$imgsWithoutAlt}/{$totalImgs} Bilder ohne Alt-Text"]; }
        else { $checks[] = ['✗', "{$imgsWithoutAlt}/{$totalImgs} Bilder ohne Alt-Text"]; }

        return ['score' => min(100, $score), 'checks' => $checks];
    }

    private function scoreSeo(\DOMXPath $xpath): array
    {
        $checks = [];
        $score = 0;

        // Title
        $title = $xpath->query('//title')->item(0)?->textContent ?? '';
        if (strlen($title) > 10 && strlen($title) < 70) { $score += 10; $checks[] = ['✓', "Title-Tag vorhanden ({$title})"]; }
        elseif ($title) { $score += 5; $checks[] = ['~', 'Title-Tag zu lang oder zu kurz']; }
        else { $checks[] = ['✗', 'Kein Title-Tag']; }

        // Meta description
        $desc = $xpath->query('//meta[@name="description"]/@content')->item(0)?->value ?? '';
        if (strlen($desc) > 50 && strlen($desc) < 160) { $score += 10; $checks[] = ['✓', 'Meta Description optimal']; }
        elseif ($desc) { $score += 5; $checks[] = ['~', 'Meta Description zu lang/kurz']; }
        else { $checks[] = ['✗', 'Keine Meta Description']; }

        // H1
        $h1 = $xpath->query('//h1');
        if ($h1->length === 1) { $score += 10; $checks[] = ['✓', 'Genau ein H1-Tag']; }
        elseif ($h1->length > 1) { $score += 5; $checks[] = ['~', "{$h1->length} H1-Tags (sollte 1 sein)"]; }
        else { $checks[] = ['✗', 'Kein H1-Tag']; }

        // Heading hierarchy
        $h2 = $xpath->query('//h2')->length;
        $h3 = $xpath->query('//h3')->length;
        if ($h2 > 0 && $h3 > 0) { $score += 10; $checks[] = ['✓', "Gute Heading-Struktur (H2: {$h2}, H3: {$h3})"]; }
        elseif ($h2 > 0) { $score += 5; $checks[] = ['~', 'Keine H3-Tags unter H2']; }
        else { $checks[] = ['✗', 'Keine Überschriften-Struktur']; }

        // Alt text on images
        preg_match_all('/<img[^>]+>/i', $xpath->document->saveHTML(), $imgs);
        $total = count($imgs[0]);
        $withAlt = 0;
        foreach ($imgs[0] ?? [] as $img) {
            if (preg_match('/alt=["\'][^"\']*["\']/i', $img) && !preg_match('/alt=["\']["\']/i', $img)) $withAlt++;
        }
        if ($total === 0 || $withAlt === $total) { $score += 10; $checks[] = ['✓', 'Alle Bilder haben Alt-Text']; }
        else { $score += 5; $checks[] = ['~', "{$withAlt}/{$total} Bilder mit Alt-Text"]; }

        // Open Graph
        $og = $xpath->query('//meta[starts-with(@property, "og:")]');
        if ($og->length >= 3) { $score += 5; $checks[] = ['✓', 'Open Graph Tags vorhanden']; }
        else { $checks[] = ['~', 'Open Graph Tags fehlen (Social Media Preview)']; }

        // Canonical
        $canonical = $xpath->query('//link[@rel="canonical"]/@href')->item(0)?->value ?? '';
        if ($canonical) { $score += 5; $checks[] = ['✓', 'Canonical URL gesetzt']; }
        else { $checks[] = ['~', 'Keine Canonical URL']; }

        // Structured data
        $jsonLd = $xpath->query('//script[@type="application/ld+json"]');
        if ($jsonLd->length > 0) { $score += 10; $checks[] = ['✓', 'Structured Data (JSON-LD) vorhanden']; }
        else { $checks[] = ['✗', 'Kein Structured Data — Schema.org empfohlen']; }

        // Sitemap
        $sitemapUrl = ($canonical ? parse_url($canonical, PHP_URL_SCHEME) . '://' . parse_url($canonical, PHP_URL_HOST) : 'https://' . parse_url($url, PHP_URL_HOST)) . '/sitemap.xml';
        $hasSitemap = @file_get_contents($sitemapUrl, false, stream_context_create(['http' => ['timeout' => 5]])) !== false;
        if ($hasSitemap) { $score += 5; $checks[] = ['✓', 'XML Sitemap gefunden']; }
        else { $checks[] = ['~', 'Keine XML Sitemap gefunden']; }

        // robots.txt
        $hasRobots = @file_get_contents('https://' . parse_url($url, PHP_URL_HOST) . '/robots.txt', false, stream_context_create(['http' => ['timeout' => 5]])) !== false;
        if ($hasRobots) { $score += 5; $checks[] = ['✓', 'robots.txt vorhanden']; }
        else { $checks[] = ['~', 'Keine robots.txt']; }

        return ['score' => min(100, $score), 'checks' => $checks];
    }

    private function scoreMobile(\DOMXPath $xpath, string $html): array
    {
        $checks = [];
        $score = 0;

        // Viewport
        $viewport = $xpath->query('//meta[@name="viewport"]/@content')->item(0)?->value ?? '';
        if (str_contains($viewport, 'width=device-width')) { $score += 25; $checks[] = ['✓', 'Viewport Meta-Tag korrekt']; }
        else { $checks[] = ['✗', 'Viewport Meta-Tag fehlerhaft oder fehlt']; }

        // Responsive units
        if (preg_match('/\d+(rem|em|vw|vh|%)/', $html)) { $score += 25; $checks[] = ['✓', 'Responsive Einheiten (rem, vw, %) verwendet']; }
        else { $checks[] = ['~', 'Nur absolute Einheiten (px) — nicht responsive']; }

        // Media queries
        if (preg_match('/@media\s*\(/', $html)) { $score += 25; $checks[] = ['✓', 'CSS Media Queries vorhanden']; }
        else { $checks[] = ['✗', 'Keine Media Queries — nicht responsive']; }

        // Touch-friendly (button/link sizes)
        if (preg_match('/padding:\s*\d+px\s+\d+px/', $html) || preg_match('/\.btn/', $html)) {
            $score += 25; $checks[] = ['✓', 'Touch-Elemente erkannt (Buttons/Links)'];
        } else {
            $checks[] = ['~', 'Keine erkennbaren Touch-optimierten Elemente'];
        }

        return ['score' => min(100, $score), 'checks' => $checks];
    }

    private function scoreContent(\DOMXPath $xpath, string $industry): array
    {
        $checks = [];
        $score = 0;
        $html = $xpath->document->saveHTML();
        $text = strip_tags($html);
        $wordCount = str_word_count($text);

        // Word count
        if ($wordCount > 500) { $score += 15; $checks[] = ['✓', "{$wordCount} Wörter (gut für SEO)"]; }
        elseif ($wordCount > 200) { $score += 10; $checks[] = ['~', "{$wordCount} Wörter (mehr Content empfohlen)"]; }
        else { $checks[] = ['✗', "Nur {$wordCount} Wörter — zu wenig Content"]; }

        // Contact section
        if (preg_match('/(kontakt|contact|anfahrt|erreichen)/i', $html)) { $score += 15; $checks[] = ['✓', 'Kontakt-Sektion gefunden']; }
        else { $checks[] = ['✗', 'Keine Kontakt-Sektion erkennbar']; }

        // Impressum (DE legal requirement!)
        if (preg_match('/impressum/i', $html)) { $score += 15; $checks[] = ['✓', 'Impressum vorhanden (Pflicht!)']; }
        else { $checks[] = ['✗', '⚠️ KEIN IMPRESSUM — rechtlich Pflicht in DE/AT!']; }

        // Datenschutz (DE legal requirement!)
        if (preg_match('/(datenschutz|privacy|datenschutzerklärung)/i', $html)) { $score += 15; $checks[] = ['✓', 'Datenschutzerklärung vorhanden (Pflicht!)']; }
        else { $checks[] = ['✗', '⚠️ KEINE DATENSCHUTZERKLÄRUNG — rechtlich Pflicht!']; }

        // Team/About
        if (preg_match('/(team|über uns|about|vorstellung)/i', $html)) { $score += 10; $checks[] = ['✓', 'Team/Über-uns Sektion vorhanden']; }
        else { $checks[] = ['~', 'Keine Team/Über-uns Sektion']; }

        // Services
        if (preg_match('/(leistungen|services|angebot|therapie|behandlung)/i', $html)) { $score += 10; $checks[] = ['✓', 'Leistungen/Services dokumentiert']; }
        else { $checks[] = ['~', 'Keine klare Leistungsübersicht']; }

        // Blog/News
        if (preg_match('/(blog|news|aktuelles|beitrag|artikel)/i', $html)) { $score += 10; $checks[] = ['✓', 'Blog/News-Sektion vorhanden']; }
        else { $checks[] = ['~', 'Kein Blog — regelmäßiger Content hilft SEO']; }

        // Social media links
        if (preg_match('/(facebook|instagram|linkedin|twitter|tiktok)\.com/i', $html)) { $score += 10; $checks[] = ['✓', 'Social Media Links vorhanden']; }
        else { $checks[] = ['~', 'Keine Social Media Links']; }

        return ['score' => min(100, $score), 'checks' => $checks];
    }

    private function scoreSecurity(array $headers): array
    {
        $checks = [];
        $score = 0;

        // HTTPS
        if (($headers['X-Forwarded-Proto'] ?? '') === 'https' || ($headers['https'] ?? false)) {
            $score += 25; $checks[] = ['✓', 'HTTPS aktiviert'];
        } else {
            $checks[] = ['✗', 'Kein HTTPS — SSL-Zertifikat erforderlich!'];
        }

        // Security headers
        $secHeaders = ['X-Frame-Options', 'X-Content-Type-Options', 'X-XSS-Protection', 'Content-Security-Policy', 'Strict-Transport-Security'];
        $found = 0;
        foreach ($secHeaders as $h) {
            if (isset($headers[$h])) $found++;
        }
        if ($found >= 4) { $score += 25; $checks[] = ['✓', "{$found}/5 Security-Headers gesetzt"]; }
        elseif ($found >= 2) { $score += 15; $checks[] = ['~', "{$found}/5 Security-Headers — mehr empfohlen"]; }
        else { $checks[] = ['✗', "Nur {$found}/5 Security-Headers"]; }

        // No server version exposed
        $server = $headers['Server'] ?? '';
        if (empty($server) || !preg_match('/\d+\.\d+/', $server)) {
            $score += 25; $checks[] = ['✓', 'Server-Version nicht exposed'];
        } else {
            $checks[] = ['~', "Server-Version exposed: {$server}"];
        }

        // Referrer-Policy
        if (isset($headers['Referrer-Policy'])) { $score += 25; $checks[] = ['✓', 'Referrer-Policy gesetzt']; }
        else { $checks[] = ['~', 'Referrer-Policy fehlt']; }

        return ['score' => min(100, $score), 'checks' => $checks];
    }

    private function scoreDesign(\DOMXPath $xpath, string $html): array
    {
        $checks = [];
        $score = 0;

        // CSS Framework
        if (preg_match('/(bootstrap|tailwind|bulma|foundation)/i', $html)) { $score += 20; $checks[] = ['✓', 'Modernes CSS-Framework erkannt']; }
        else { $checks[] = ['~', 'Kein CSS-Framework erkannt — Custom CSS?']; }

        // Consistent fonts
        preg_match_all('/font-family:\s*([^;]+)/', $html, $fonts);
        $uniqueFonts = array_unique(array_map('trim', $fonts[1] ?? []));
        if (count($uniqueFonts) <= 3) { $score += 20; $checks[] = ['✓', count($uniqueFonts) . ' Schriftfamilien (konsistent)']; }
        else { $checks[] = ['~', count($uniqueFonts) . ' Schriftfamilien — zu viele']; }

        // CTA buttons
        if (preg_match('/(btn|button|cta)/i', $html)) { $score += 20; $checks[] = ['✓', 'Call-to-Action Buttons erkannt']; }
        else { $checks[] = ['~', 'Keine erkennbaren CTA-Buttons']; }

        // Images
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/', $html, $imgs);
        if (count($imgs[1]) > 0) { $score += 20; $checks[] = ['✓', count($imgs[1]) . ' Bilder vorhanden']; }
        else { $checks[] = ['~', 'Keine Bilder — visuelle Elemente empfohlen']; }

        // Blog/News
        if (preg_match('/(blog|news|aktuelles)/i', $html)) { $score += 20; $checks[] = ['✓', 'Blog/News-Sektion vorhanden']; }
        else { $checks[] = ['~', 'Kein Blog — Content-Marketing empfohlen']; }

        return ['score' => min(100, $score), 'checks' => $checks];
    }

    private function buildRecommendations(array ...$categories): array
    {
        $recs = [];
        foreach ($categories as $cat) {
            foreach ($cat['checks'] ?? [] as $check) {
                if ($check[0] === '✗') {
                    $recs[] = str_replace(['⚠️ ', '✗ '], ['', ''], $check[1]);
                }
            }
        }
        return array_slice(array_unique($recs), 0, 10);
    }
}
