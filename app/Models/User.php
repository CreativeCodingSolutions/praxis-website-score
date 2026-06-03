<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function getPlanAttribute(): string
    {
        return $this->subscription?->plan ?? 'free';
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
