<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan',
        'reports_limit',
        'reports_used',
        'valid_until',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return $this->valid_until === null || $this->valid_until->isFuture();
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

    public function incrementUsage(): void
    {
        if ($this->reports_limit > 0) {
            $this->increment('reports_used');
        }
    }
}
