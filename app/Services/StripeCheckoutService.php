<?php

namespace App\Services;

use App\Models\User;
use Stripe\StripeClient;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Webhook;
use Stripe\Event;
use Illuminate\Support\Facades\Log;

class StripeCheckoutService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.secret'));
    }

    /**
     * Get the price ID for a given plan.
     */
    public function getPriceId(string $plan): ?string
    {
        $prices = [
            'pro' => config('stripe.prices.pro'),
            'business' => config('stripe.prices.business'),
        ];

        return $prices[$plan] ?? null;
    }

    /**
     * Create a Stripe Checkout Session for a subscription.
     */
    public function createCheckoutSession(User $user, string $plan): CheckoutSession
    {
        $priceId = $this->getPriceId($plan);

        if (!$priceId) {
            throw new \InvalidArgumentException("No price configured for plan: {$plan}");
        }

        $params = [
            'customer_email' => $user->email,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'user_id' => $user->id,
                'plan' => $plan,
                'product' => config('app.name'),
            ],
            'subscription_data' => [
                'metadata' => [
                    'user_id' => $user->id,
                    'plan' => $plan,
                ],
            ],
        ];

        // If user already has a Stripe customer ID, use it
        if ($user->stripe_id) {
            $params['customer'] = $user->stripe_id;
            unset($params['customer_email']);
        }

        return $this->stripe->checkout->sessions->create($params);
    }

    /**
     * Retrieve and verify a checkout session.
     */
    public function retrieveSession(string $sessionId, array $expand = []): CheckoutSession
    {
        return $this->stripe->checkout->sessions->retrieve($sessionId, [
            'expand' => array_merge(['subscription'], $expand),
        ]);
    }

    /**
     * Handle successful checkout — create/update subscription record.
     */
    public function handleSuccess(string $sessionId): void
    {
        $session = $this->retrieveSession($sessionId, ['subscription']);

        $user = User::findOrFail($session->metadata->user_id);
        $subscription = $session->subscription;

        if (!$subscription) {
            Log::warning("No subscription found in session {$sessionId}");
            return;
        }

        // Update user
        $user->update([
            'stripe_id' => $subscription->customer,
            'stripe_status' => $subscription->status,
            'plan' => $session->metadata->plan ?? 'pro',
            'plan_ends_at' => $subscription->current_period_end
                ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)
                : null,
        ]);

        // Create or update subscription record
        $user->subscriptions()->updateOrCreate(
            ['stripe_id' => $subscription->id],
            [
                'stripe_price' => $subscription->items->data[0]->price->id ?? null,
                'plan' => $session->metadata->plan ?? 'pro',
                'stripe_status' => $subscription->status,
                'quantity' => $subscription->items->data[0]->quantity ?? 1,
                'trial_ends_at' => $subscription->trial_end
                    ? \Carbon\Carbon::createFromTimestamp($subscription->trial_end)
                    : null,
                'current_period_start' => $subscription->current_period_start
                    ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_start)
                    : null,
                'current_period_end' => $subscription->current_period_end
                    ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)
                    : null,
                'ends_at' => $subscription->ended_at
                    ? \Carbon\Carbon::createFromTimestamp($subscription->ended_at)
                    : null,
            ]
        );

        Log::info("Subscription activated for user {$user->id}: {$session->metadata->plan}");
    }

    /**
     * Handle Stripe webhook events.
     */
    public function handleWebhook(string $payload, string $sigHeader): Event
    {
        return Webhook::constructEvent(
            $payload,
            $sigHeader,
            config('stripe.webhook_secret')
        );
    }

    /**
     * Handle subscription updated/created webhook.
     */
    public function handleSubscriptionUpdated(\Stripe\Subscription $subscription): void
    {
        $user = User::where('stripe_id', $subscription->customer)->first();
        if (!$user) {
            Log::warning("User not found for Stripe customer: {$subscription->customer}");
            return;
        }

        $plan = $subscription->metadata->plan ?? 'pro';

        if (in_array($subscription->status, ['active', 'trialing', 'past_due'])) {
            $user->update([
                'plan' => $plan,
                'stripe_status' => $subscription->status,
                'plan_ends_at' => $subscription->current_period_end
                    ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)
                    : null,
            ]);
        } elseif (in_array($subscription->status, ['canceled', 'unpaid'])) {
            $user->update([
                'plan' => 'free',
                'stripe_status' => $subscription->status,
                'plan_ends_at' => null,
            ]);
        }

        // Update subscription record
        $user->subscriptions()->updateOrCreate(
            ['stripe_id' => $subscription->id],
            [
                'stripe_price' => $subscription->items->data[0]->price->id ?? null,
                'plan' => $plan,
                'stripe_status' => $subscription->status,
                'trial_ends_at' => $subscription->trial_end
                    ? \Carbon\Carbon::createFromTimestamp($subscription->trial_end)
                    : null,
                'current_period_start' => $subscription->current_period_start
                    ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_start)
                    : null,
                'current_period_end' => $subscription->current_period_end
                    ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)
                    : null,
                'ends_at' => $subscription->ended_at
                    ? \Carbon\Carbon::createFromTimestamp($subscription->ended_at)
                    : null,
            ]
        );
    }

    /**
     * Cancel a user's subscription.
     */
    public function cancelSubscription(User $user): void
    {
        if (!$user->stripe_id) {
            return;
        }

        $subscriptions = $this->stripe->subscriptions->all([
            'customer' => $user->stripe_id,
            'status' => 'active',
        ]);

        foreach ($subscriptions->data as $subscription) {
            $this->stripe->subscriptions->cancel($subscription->id);
        }

        $user->update([
            'plan' => 'free',
            'stripe_status' => 'canceled',
            'plan_ends_at' => null,
        ]);
    }

    /**
     * Create a billing portal session for managing subscription.
     */
    public function createBillingPortalSession(User $user, string $returnUrl): \Stripe\BillingPortal\Session
    {
        if (!$user->stripe_id) {
            // Create customer first
            $customer = $this->stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            $user->update(['stripe_id' => $customer->id]);
        }

        return $this->stripe->billingPortal->sessions->create([
            'customer' => $user->stripe_id,
            'return_url' => $returnUrl,
        ]);
    }
}
