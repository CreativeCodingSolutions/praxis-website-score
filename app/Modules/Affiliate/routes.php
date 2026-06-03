<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Affiliate\Controllers\AffiliateController;

Route::middleware(['auth', 'verified'])->prefix('affiliate')->name('affiliate.')->group(function () {
    Route::get('/', [AffiliateController::class, 'dashboard'])->name('dashboard');
    Route::post('/generate', [AffiliateController::class, 'generate'])->name('generate');
});
