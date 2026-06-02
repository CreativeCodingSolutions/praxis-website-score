    // Stripe routes
    Route::middleware('auth')->group(function () {
        Route::post('/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
        Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
        Route::post('/subscription/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');
    });
    Route::post('/webhook/stripe', [StripeController::class, 'webhook'])->name('stripe.webhook');
