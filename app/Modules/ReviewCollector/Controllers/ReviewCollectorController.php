<?php

namespace App\Modules\ReviewCollector\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewCollectorController extends Controller
{
    /**
     * Dashboard: Review-Link generieren + Review-Liste anzeigen
     */
    public function index()
    {
        $user = Auth::user();

        // Get or generate a persistent review link token for this user
        $reviewToken = $user->review_token ?? $this->createReviewToken($user);

        $reviewLink = url('/review/' . $reviewToken);

        // Get reviews for this user (stored in session for demo / would be DB in production)
        $reviews = session('review_collector_reviews_' . $user->id, []);

        return view('review-collector.index', compact('reviewLink', 'reviews', 'user'));
    }

    /**
     * Neuen Review-Link generieren (Token rotieren)
     */
    public function generateLink(Request $request)
    {
        $user = Auth::user();
        $this->createReviewToken($user);

        return redirect()->route('review-collector.index')
            ->with('success', 'Neuer Review-Link wurde generiert.');
    }

    /**
     * Reviews listen (API/JSON endpoint für AJAX)
     */
    public function reviews()
    {
        $user = Auth::user();
        $reviews = session('review_collector_reviews_' . $user->id, []);

        return response()->json([
            'reviews' => $reviews,
            'total' => count($reviews),
        ]);
    }

    /**
     * Öffentliches Antwort-Formular (Review abgeben)
     */
    public function respond(string $token)
    {
        // Validate token — find user by review_token
        $user = \App\Models\User::where('review_token', $token)->first();

        if (!$user) {
            abort(404, 'Review-Link ungültig oder abgelaufen.');
        }

        return view('review-collector.respond', compact('token', 'user'));
    }

    /**
     * Antwort auf eine Review speichern
     */
    public function submitResponse(Request $request, int $id)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $reviews = session('review_collector_reviews_' . $user->id, []);

        if (isset($reviews[$id])) {
            $reviews[$id]['response'] = $validated['response'];
            $reviews[$id]['responded_at'] = now()->toDateTimeString();
            session(['review_collector_reviews_' . $user->id => $reviews]);
        }

        return redirect()->route('review-collector.index')
            ->with('success', 'Antwort wurde gespeichert.');
    }

    /**
     * Review löschen
     */
    public function destroy(int $id)
    {
        $user = Auth::user();
        $reviews = session('review_collector_reviews_' . $user->id, []);

        if (isset($reviews[$id])) {
            unset($reviews[$id]);
            session(['review_collector_reviews_' . $user->id => array_values($reviews)]);
        }

        return redirect()->route('review-collector.index')
            ->with('success', 'Review wurde gelöscht.');
    }

    /**
     * Erstelle einen neuen Review-Token für den User
     */
    private function createReviewToken(\App\Models\User $user): string
    {
        $token = Str::random(32);
        $user->update(['review_token' => $token]);
        return $token;
    }
}
