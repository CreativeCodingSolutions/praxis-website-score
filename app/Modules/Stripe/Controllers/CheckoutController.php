<?php

namespace App\Modules\Stripe\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StripeCheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct(
        protected StripeCheckoutService $stripeService
    ) {}

    /**
     * Show pricing page.
     */
    public function pricing()
    {
        return view('pricing');
    }

    /**
     * Create a checkout session and redirect to Stripe.
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:pro,business',
        ]);

        $user = Auth::user();

        try {
            $session = $this->stripeService->createCheckoutSession($user, $request->plan);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe checkout error: ' . $e->getMessage());
            return back()->with('error', 'Could not create checkout session. Please try again.');
        }
    }

    /**
     * Handle successful checkout.
     */
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('dashboard')->with('error', 'Invalid checkout session.');
        }

        try {
            $this->stripeService->handleSuccess($sessionId);
            return redirect()->route('dashboard')->with('success', 'Subscription activated successfully!');
        } catch (\Exception $e) {
            Log::error('Stripe success error: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Could not verify subscription. Please contact support.');
        }
    }

    /**
     * Handle cancelled checkout.
     */
    public function cancel()
    {
        return redirect()->route('pricing')->with('error', 'Checkout was cancelled.');
    }
}
