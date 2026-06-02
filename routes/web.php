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
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Dashboard
Route::middleware('auth')->group(function () {
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

// Feature Modules (auto-loaded)
$modules = glob(base_path('app/Modules/*/routes.php'));
foreach ($modules as $routes) {
    $moduleName = basename(dirname($routes));
    $envKey = 'FEATURE_' . strtoupper($moduleName);
    if (env($envKey, false)) {
        require $routes;
    }
}
