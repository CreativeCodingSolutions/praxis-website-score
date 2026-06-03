<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ApiAccess\Controllers\ApiKeysController;

Route::middleware(['auth', 'verified'])->prefix('api-keys')->name('apikeys.')->group(function () {
    Route::get('/', [ApiKeysController::class, 'index'])->name('index');
    Route::post('/', [ApiKeysController::class, 'store'])->name('store');
    Route::delete('/{id}', [ApiKeysController::class, 'destroy'])->name('destroy');
});
