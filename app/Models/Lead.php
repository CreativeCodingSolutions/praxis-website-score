<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lead extends Model
{
    protected $fillable = [
        'guest_report_id', 'email', 'name',
        'ip_address', 'consent_given', 'consent_text',
        'source', 'email_verified_at', 'verification_token',
    ];

    protected $casts = [
        'consent_given' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function guestReport()
    {
        return $this->belongsTo(GuestReport::class);
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function markAsVerified(): void
    {
        $this->forceFill([
            'email_verified_at' => now(),
            'verification_token' => null,
        ])->save();
    }

    public function generateVerificationToken(): string
    {
        $token = Str::random(64);
        $this->forceFill(['verification_token' => $token])->save();
        return $token;
    }
}
