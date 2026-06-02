<?php
// app/Modules/Stripe/routes.php

use App\Modules\Stripe\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('pricing', [CheckoutController::class, 'pricing'])->name('pricing');
    Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});
