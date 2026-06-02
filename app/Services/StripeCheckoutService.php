<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Customer;
use App\Models\User;

class StripeCheckoutService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a checkout session for subscription
     */
    public function createSubscriptionSession(User $user, string $priceId, string $successUrl, string $cancelUrl): Session
    {
        $params = [
            'customer_email' => $user->email,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => $successUrl . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $cancelUrl,
            'metadata' => [
                'user_id' => $user->id,
                'product' => config('app.name'),
            ],
        ];

        // If user already has a Stripe customer ID, use it
        if ($user->stripe_id) {
            $params['customer'] = $user->stripe_id;
            unset($params['customer_email']);
        }

        return Session::create($params);
    }

    /**
     * Create a one-time payment session
     */
    public function createOneTimeSession(User $user, string $priceId, string $successUrl, string $cancelUrl): Session
    {
        return Session::create([
            'customer_email' => $user->email,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $successUrl . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $cancelUrl,
            'metadata' => [
                'user_id' => $user->id,
            ],
        ]);
    }

    /**
     * Verify checkout session
     */
    public function verifySession(string $sessionId): ?Session
    {
        try {
            return Session::retrieve($sessionId);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Create a billing portal session for managing subscription
     */
    public function createBillingPortalSession(User $user, string $returnUrl): \Stripe\BillingPortal\Session
    {
        if (!$user->stripe_id) {
            // Create customer first
            $customer = Customer::create(['email' => $user->email, 'name' => $user->name]);
            $user->update(['stripe_id' => $customer->id]);
        }

        return \Stripe\BillingPortal\Session::create([
            'customer' => $user->stripe_id,
            'return_url' => $returnUrl,
        ]);
    }
}
