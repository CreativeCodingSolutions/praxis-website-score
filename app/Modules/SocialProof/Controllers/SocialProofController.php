<?php

namespace App\Modules\SocialProof\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialProofController extends Controller
{
    private function getTestimonials(Request $request)
    {
        $user = $request->user();
        $key = 'social_proof_testimonials_' . $user->id;

        if (!session()->has($key)) {
            session()->put($key, [
                ['id' => 1, 'name' => 'Dr. Schmidt', 'role' => 'Praxisinhaberin', 'text' => 'Der Score hat uns geholfen, unsere Website deutlich zu verbessern!', 'rating' => 5, 'active' => 1],
                ['id' => 2, 'name' => 'Müller GmbH', 'role' => 'Geschäftsführer', 'text' => 'Professionelle Analyse, klare Empfehlungen. Sehr empfehlenswert.', 'rating' => 4, 'active' => 1],
            ]);
        }

        return session()->get($key);
    }

    public function index(Request $request)
    {
        $testimonials = $this->getTestimonials($request);
        return view('social-proof.index', compact('testimonials'));
    }

    public function create()
    {
        return view('social-proof.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'text' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = $request->user();
        $key = 'social_proof_testimonials_' . $user->id;
        $testimonials = session()->get($key, []);

        $newId = empty($testimonials) ? 1 : max(array_column($testimonials, 'id')) + 1;
        $testimonials[] = [
            'id' => $newId,
            'name' => $validated['name'],
            'role' => $validated['role'],
            'text' => $validated['text'],
            'rating' => $validated['rating'],
            'active' => 1,
        ];

        session()->put($key, $testimonials);

        return redirect()->route('social-proof.index')->with('success', 'Testimonial hinzugefügt!');
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $key = 'social_proof_testimonials_' . $user->id;
        $testimonials = session()->get($key, []);

        $testimonials = array_values(array_filter($testimonials, fn($t) => $t['id'] != $id));
        session()->put($key, $testimonials);

        return redirect()->route('social-proof.index')->with('success', 'Testimonial gelöscht.');
    }

    public function toggle(Request $request, $id)
    {
        $user = $request->user();
        $key = 'social_proof_testimonials_' . $user->id;
        $testimonials = session()->get($key, []);

        foreach ($testimonials as &$t) {
            if ($t['id'] == $id) {
                $t['active'] = $t['active'] ? 0 : 1;
                break;
            }
        }

        session()->put($key, $testimonials);

        return redirect()->route('social-proof.index')->with('success', 'Status geändert.');
    }
}
