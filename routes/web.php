<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestScoreController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StripeController;

// Public
Route::get('/', function () { return view('landing'); })->name('landing');
Route::get('/pricing', [DashboardController::class, 'pricing'])->name('pricing');

// Guest Score — no login required
Route::post('/check', [GuestScoreController::class, 'analyze'])->name('guest.score.analyze');
Route::get('/score/{uuid}', [GuestScoreController::class, 'show'])->name('guest.score.show');
Route::post('/score/{uuid}/capture', [GuestScoreController::class, 'captureEmail'])->name('guest.score.capture');

// Legal Pages
Route::get('/impressum', function () { return view('legal.impressum'); })->name('legal.impressum');
Route::get('/datenschutz', function () { return view('legal.datenschutz'); })->name('legal.datenschutz');
Route::get('/agb', function () { return view('legal.agb'); })->name('legal.agb');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
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

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/check', [DashboardController::class, 'check'])->name('dashboard.check');
    Route::get('/dashboard/report/{report}', [DashboardController::class, 'showReport'])->name('dashboard.report');
    Route::get('/dashboard/report/{report}/pdf', [DashboardController::class, 'downloadPdf'])->name('dashboard.pdf');
    Route::get('/dashboard/leads', [DashboardController::class, 'leads'])->name('dashboard.leads');
    Route::delete('/dashboard/leads/{id}', [DashboardController::class, 'deleteLead'])->name('dashboard.leads.delete');

    // Stripe
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
    Route::post('/subscription/cancel', [StripeController::class, 'subscriptionCancel'])->name('stripe.cancel');
});

// Stripe Webhook (no CSRF)
Route::post('/webhook/stripe', [StripeController::class, 'webhook'])->name('stripe.webhook');

// Module Loader - loads routes from modules with feature flags enabled
$modules = glob(base_path('app/Modules/*/routes.php'));
foreach ($modules as $routes) {
    $moduleName = basename(dirname($routes));
    $envKey = 'FEATURE_' . strtoupper(preg_replace('/([a-z])([A-Z])/', '$1_$2', $moduleName));
    if (env($envKey, false)) {
        require $routes;
    }
}

// Sitemap
require base_path('routes/sitemap.php');
