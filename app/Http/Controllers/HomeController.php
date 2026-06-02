<?php

namespace App\Http\Controllers;

use App\Services\WebsiteScoreService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function pricing()
    {
        return view('pricing');
    }

    /**
     * Quick check API – kein Auth, rate-limited.
     */
    public function quickCheck(Request $request, WebsiteScoreService $scoreService)
    {
        $request->validate([
            'url' => 'required|url|max:500',
        ]);

        $result = $scoreService->analyze($request->input('url'));

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'error' => $result['error'],
            ], 422);
        }

        // Für Quick Check nur Zusammenfassung zurückgeben
        return response()->json([
            'success' => true,
            'url' => $result['url'],
            'domain' => $result['domain'],
            'overall_score' => $result['overall_score'],
            'categories' => collect($result['categories'])->map(fn($cat) => [
                'score' => $cat['score'],
            ]),
            'top_recommendations' => collect($result['recommendations'])->where('priority', 'high')->take(3)->values(),
        ]);
    }
}
