<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Reporting\Controllers\ReportingController;

Route::middleware(['auth', 'verified'])->prefix('reporting')->name('reporting.')->group(function () {
    Route::get('/', [ReportingController::class, 'index'])->name('index');
    Route::post('/generate', [ReportingController::class, 'generate'])->name('generate');
    Route::get('/download/{id}', [ReportingController::class, 'download'])->name('download');
    Route::get('/scheduled', [ReportingController::class, 'scheduled'])->name('scheduled');
    Route::post('/scheduled', [ReportingController::class, 'storeScheduled'])->name('scheduled.store');
    Route::delete('/scheduled/{id}', [ReportingController::class, 'deleteScheduled'])->name('scheduled.delete');
});
