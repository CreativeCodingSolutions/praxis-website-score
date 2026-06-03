<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TeamManagement\Controllers\TeamController;

Route::middleware(['auth', 'verified'])->prefix('team')->name('team.')->group(function () {
    Route::get('/', [TeamController::class, 'index'])->name('index');
    Route::post('/invite', [TeamController::class, 'invite'])->name('invite');
    Route::delete('/{id}', [TeamController::class, 'remove'])->name('remove');
    Route::patch('/{id}/role', [TeamController::class, 'updateRole'])->name('role');
});
