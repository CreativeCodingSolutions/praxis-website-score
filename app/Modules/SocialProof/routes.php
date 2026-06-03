<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SocialProof\Controllers\SocialProofController;

Route::middleware(['auth', 'verified'])->prefix('social-proof')->name('social-proof.')->group(function () {
    Route::get('/', [SocialProofController::class, 'index'])->name('index');
    Route::get('/create', [SocialProofController::class, 'create'])->name('create');
    Route::post('/', [SocialProofController::class, 'store'])->name('store');
    Route::delete('/{id}', [SocialProofController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/toggle', [SocialProofController::class, 'toggle'])->name('toggle');
});
