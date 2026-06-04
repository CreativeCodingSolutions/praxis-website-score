<?php
use Illuminate\Support\Facades\Route;
use App\Modules\AppointmentBooking\Controllers\AppointmentController;
use App\Modules\AppointmentBooking\Controllers\BookingPageController;
Route::middleware(['auth', 'web'])->prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/create', [AppointmentController::class, 'create'])->name('create');
    Route::post('/store', [AppointmentController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AppointmentController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AppointmentController::class, 'update'])->name('update');
    Route::delete('/{id}', [AppointmentController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/confirm', [AppointmentController::class, 'confirm'])->name('confirm');
    Route::post('/{id}/cancel', [AppointmentController::class, 'cancel'])->name('cancel');
});
// Öffentliche Buchungsseite (kein Auth)
Route::get('/book/{slug}', [BookingPageController::class, 'show'])->name('booking.page');
Route::post('/book/{slug}/submit', [BookingPageController::class, 'submit'])->name('booking.submit');
