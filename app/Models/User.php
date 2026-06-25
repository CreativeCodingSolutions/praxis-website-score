<?php

namespace App\Models;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'stripe_status',
        'plan',
        'trial_ends_at',
        'plan_ends_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'trial_ends_at' => 'datetime',
            'plan_ends_at' => 'datetime',
        ];
    }

    /**
     * Override the password reset notification to use our custom branded version.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(): ?Subscription
    {
        return $this->subscriptions()
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>', now());
            })
            ->latest('current_period_end')
            ->first();
    }

    public function isPro(): bool
    {
        return in_array($this->plan, ['pro', 'business']) &&
               ($this->plan_ends_at === null || $this->plan_ends_at->isFuture());
    }

    public function isBusiness(): bool
    {
        return $this->plan === 'business' &&
               ($this->plan_ends_at === null || $this->plan_ends_at->isFuture());
    }

    public function getReportsLimitAttribute(): int
    {
        $plan = $this->plan;
        return match ($plan) {
            'business' => PHP_INT_MAX,
            'pro' => config('app.plan_pro_reports', 30),
            default => config('app.plan_free_reports', 1),
        };
    }

    public function getReportsUsedAttribute(): int
    {
        return $this->reports()->count();
    }

    public function getReportsRemainingAttribute(): int
    {
        $remaining = $this->reports_limit - $this->reports_used;
        return max(0, $remaining);
    }

    public function canCreateReport(): bool
    {
        return $this->reports_used < $this->reports_limit;
    }

    public function hasPaidPlan(): bool
    {
        return in_array($this->plan, ['pro', 'business']);
    }
}
