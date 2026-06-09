<?php

namespace App\Http\Controllers;

use App\Services\StripeCheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function __construct(
        protected StripeCheckoutService $stripeService
    ) {}

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

    /**
     * Handle Stripe webhooks.
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = $this->stripeService->handleWebhook($payload, $sigHeader);
        } catch (\Exception $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return response('Webhook error', 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                try {
                    $this->stripeService->handleSuccess($session->id);
                } catch (\Exception $e) {
                    Log::error('Stripe checkout.session.completed error: ' . $e->getMessage());
                }
                break;

            case 'customer.subscription.updated':
            case 'customer.subscription.created':
                $subscription = $event->data->object;
                $this->stripeService->handleSubscriptionUpdated($subscription);
                break;

            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                $this->stripeService->handleSubscriptionUpdated($subscription);
                break;

            case 'invoice.paid':
                $invoice = $event->data->object;
                Log::info("Invoice paid: {$invoice->id}");
                break;

            case 'invoice.payment_failed':
                $invoice = $event->data->object;
                Log::warning("Invoice payment failed: {$invoice->id}");
                break;

            default:
                Log::info('Unhandled Stripe event type: ' . $event->type);
        }

        return response('OK', 200);
    }

    /**
     * Cancel subscription (redirect to billing portal).
     */
    public function subscriptionCancel(Request $request)
    {
        $user = Auth::user();

        try {
            $portal = $this->stripeService->createBillingPortalSession($user, route('dashboard'));
            return redirect($portal->url);
        } catch (\Exception $e) {
            Log::error('Stripe portal error: ' . $e->getMessage());
            return back()->with('error', 'Could not open billing portal. Please contact support.');
        }
    }
}
