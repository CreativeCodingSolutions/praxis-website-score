<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StripeController;

// Public
Route::get('/', function () { return view('landing'); })->name('landing');
Route::get('/pricing', [DashboardController::class, 'pricing'])->name('pricing');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
<<<<<<< HEAD
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
=======
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
>>>>>>> f0a8cae41bc5b63c29517ed053f8c04349c1c9e1
    Route::post('/register', [RegisterController::class, 'register']);
});

// Password Reset
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'reset'])->name('password.update');
});

// Email Verification
Route::get('/email/verify', [\App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [\App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.send');

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/check', [DashboardController::class, 'check'])->name('dashboard.check');
    Route::get('/dashboard/report/{report}', [DashboardController::class, 'showReport'])->name('dashboard.report');
    Route::get('/dashboard/report/{report}/pdf', [DashboardController::class, 'downloadPdf'])->name('dashboard.pdf');

    // Stripe
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
    Route::post('/subscription/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');
});

// Stripe Webhook (no CSRF)
Route::post('/webhook/stripe', [StripeController::class, 'webhook'])->name('stripe.webhook');

<<<<<<< HEAD
// Module Loader - loads routes from modules with feature flags enabled
$modules = glob(base_path('app/Modules/*/routes.php'));
foreach ($modules as $routes) {
    $moduleName = basename(dirname($routes));
    if (env('FEATURE_' . strtoupper($moduleName), false)) {
=======
// Feature Modules (auto-loaded)
$modules = glob(base_path('app/Modules/*/routes.php'));
foreach ($modules as $routes) {
    $moduleName = basename(dirname($routes));
    $envKey = 'FEATURE_' . strtoupper($moduleName);
    if (env($envKey, false)) {
>>>>>>> f0a8cae41bc5b63c29517ed053f8c04349c1c9e1
        require $routes;
    }
}
