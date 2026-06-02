<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class WebCrawlerService
{
    private Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'timeout' => 15,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'de-DE,de;q=0.9,en;q=0.5',
            ],
            'allow_redirects' => true,
            'verify' => false,
        ]);
    }

    public function fetch(string $url): ?string
    {
        if (!str_starts_with($url, 'http')) {
            $url = 'https://' . $url;
        }

        try {
            $response = $this->httpClient->get($url);
            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            Log::warning("Crawler fetch failed for {$url}: " . $e->getMessage());
            return null;
        }
    }

    public function getHeaders(string $url): array
    {
        if (!str_starts_with($url, 'http')) {
            $url = 'https://' . $url;
        }

        try {
            $response = $this->httpClient->head($url);
            $headers = [];
            foreach ($response->getHeaders() as $name => $values) {
                $headers[$name] = implode(', ', $values);
            }
            return $headers;
        } catch (GuzzleException $e) {
            // Fallback to get_headers
            $context = stream_context_create([
                'http' => ['method' => 'HEAD', 'timeout' => 10, 'follow_location' => 1],
                'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
            ]);
            $raw = @get_headers($url, 1, $context);
            return $raw ?: [];
        }
    }
}
