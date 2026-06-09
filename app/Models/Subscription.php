<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_id',
        'stripe_price',
        'plan',
        'stripe_status',
        'quantity',
        'trial_ends_at',
        'current_period_start',
        'current_period_end',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'trial_ends_at' => 'datetime',
            'current_period_start' => 'datetime',
            'current_period_end' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        return in_array($this->stripe_status, ['active', 'trialing'])
            && ($this->ends_at === null || $this->ends_at->isFuture());
    }

    public function isTrialing(): bool
    {
        return $this->stripe_status === 'trialing'
            && ($this->trial_ends_at === null || $this->trial_ends_at->isFuture());
    }

    public function isCancelled(): bool
    {
        return $this->ends_at !== null && $this->ends_at->isFuture();
    }

    public function getPlanLabelAttribute(): string
    {
        return match ($this->plan) {
            'pro' => 'Pro',
            'business' => 'Business',
            default => 'Free',
        };
    }

    public function getPlanPriceAttribute(): int
    {
        return match ($this->plan) {
            'pro' => 19,
            'business' => 49,
            default => 0,
        };
    }
}
