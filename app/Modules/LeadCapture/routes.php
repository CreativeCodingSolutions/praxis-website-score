<?php

use Illuminate\Support\Facades\Route;
use App\Modules\LeadCapture\Controllers\LeadCaptureController;
use App\Modules\LeadCapture\Controllers\LeadAdminController;

// Public capture form
Route::get('/capture', [LeadCaptureController::class, 'create'])->name('leadcapture.create');
Route::post('/capture', [LeadCaptureController::class, 'store'])->name('leadcapture.store');
Route::get('/capture/thanks', [LeadCaptureController::class, 'thanks'])->name('leadcapture.thanks');

// Admin lead management
Route::middleware(['auth', 'verified'])->prefix('admin/leads')->name('leads.')->group(function () {
    Route::get('/', [LeadAdminController::class, 'index'])->name('index');
    Route::get('/{id}', [LeadAdminController::class, 'show'])->name('show');
    Route::delete('/{id}', [LeadAdminController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/score', [LeadAdminController::class, 'score'])->name('score');
});
