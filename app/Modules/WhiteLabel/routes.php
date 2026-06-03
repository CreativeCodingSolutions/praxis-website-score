<?php

use Illuminate\Support\Facades\Route;
use App\Modules\WhiteLabel\Controllers\WhiteLabelController;

Route::middleware(['auth', 'verified'])->prefix('white-label')->name('whitelabel.')->group(function () {
    Route::get('/', [WhiteLabelController::class, 'index'])->name('index');
    Route::post('/settings', [WhiteLabelController::class, 'saveSettings'])->name('settings');
    Route::post('/logo', [WhiteLabelController::class, 'uploadLogo'])->name('logo');
    Route::get('/preview', [WhiteLabelController::class, 'preview'])->name('preview');
});
