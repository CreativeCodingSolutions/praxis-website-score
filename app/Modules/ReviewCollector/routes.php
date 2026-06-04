<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ReviewCollector\Controllers\ReviewCollectorController;

// Public review submission page (no auth required — accessed via unique link)
Route::get('/review/{token}', [ReviewCollectorController::class, 'respond'])->name('review-collector.respond');

// Authenticated review management
Route::middleware(['auth', 'verified'])->prefix('review-collector')->name('review-collector.')->group(function () {
    Route::get('/', [ReviewCollectorController::class, 'index'])->name('index');
    Route::post('/generate-link', [ReviewCollectorController::class, 'generateLink'])->name('generate-link');
    Route::get('/reviews', [ReviewCollectorController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{id}/respond', [ReviewCollectorController::class, 'submitResponse'])->name('submit-response');
    Route::delete('/reviews/{id}', [ReviewCollectorController::class, 'destroy'])->name('destroy');
});
