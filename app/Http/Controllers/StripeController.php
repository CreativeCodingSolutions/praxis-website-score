<?php

namespace App\Http\Controllers;

use App\Services\StripeCheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    private StripeCheckoutService $stripe;

    public function __construct(StripeCheckoutService $stripe)
    {
        $this->stripe = $stripe;
    }

    /**
     * Redirect to Stripe Checkout
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $plan = $request->input('plan', 'pro');

        // Price IDs from .env (created in Stripe Dashboard)
        $priceIds = [
            'pro' => config('stripe.prices.pro', 'price_placeholder_pro'),
            'business' => config('stripe.prices.business', 'price_placeholder_business'),
        ];

        if (!isset($priceIds[$plan])) {
            return back()->with('error', 'Ungültiger Plan.');
        }

        try {
            $session = $this->stripe->createSubscriptionSession(
                $user,
                $priceIds[$plan],
                route('stripe.success'),
                route('pricing')
            );
            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Checkout konnte nicht erstellt werden: ' . $e->getMessage());
        }
    }

    /**
     * Handle successful checkout
     */
    public function success(Request $request)
    {
        $sessionId = $request->input('session_id');
        if (!$sessionId) {
            return redirect()->route('dashboard')->with('error', 'Ungültige Session.');
        }

        $session = $this->stripe->verifySession($sessionId);
        if (!$session) {
            return redirect()->route('dashboard')->with('error', 'Session konnte nicht verifiziert werden.');
        }

        // Get subscription details
        $user = Auth::user();
        $user->update([
            'stripe_id' => $session->customer,
            'plan' => $session->metadata['plan'] ?? 'pro',
            'plan_expires_at' => now()->addMonth(),
            'reports_limit' => $session->metadata['plan'] === 'business' ? 9999 : 30,
        ]);

        return redirect()->route('dashboard')->with('success', '🎉 Zahlung erfolgreich! Dein Pro-Plan ist jetzt aktiv.');
    }

    /**
     * Cancel subscription
     */
    public function cancel()
    {
        $user = Auth::user();
        try {
            $portal = $this->stripe->createBillingPortalSession($user, route('dashboard'));
            return redirect($portal->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Portal konnte nicht erstellt werden.');
        }
    }

    /**
     * Stripe Webhook
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            return response('Invalid signature', 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutCompleted($session);
                break;
            case 'customer.subscription.updated':
                $subscription = $event->data->object;
                $this->handleSubscriptionUpdated($subscription);
                break;
            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                $this->handleSubscriptionCancelled($subscription);
                break;
        }

        return response('OK', 200);
    }

    private function handleCheckoutCompleted($session)
    {
        $user = \App\Models\User::find($session->metadata['user_id'] ?? null);
        if ($user) {
            $user->update([
                'stripe_id' => $session->customer,
                'plan' => $session->metadata['plan'] ?? 'pro',
                'plan_expires_at' => now()->addMonth(),
                'reports_limit' => ($session->metadata['plan'] ?? '') === 'business' ? 9999 : 30,
            ]);
        }
    }

    private function handleSubscriptionUpdated($subscription)
    {
        $user = \App\Models\User::where('stripe_id', $subscription->customer)->first();
        if ($user) {
            $user->update([
                'plan_expires_at' => now()->addMonth(),
                'reports_limit' => $subscription->items->data[0]->price->id === config('stripe.prices.business') ? 9999 : 30,
            ]);
        }
    }

    private function handleSubscriptionCancelled($subscription)
    {
        $user = \App\Models\User::where('stripe_id', $subscription->customer)->first();
        if ($user) {
            $user->update(['plan' => 'free', 'reports_limit' => 1, 'plan_expires_at' => null]);
        }
    }
}
