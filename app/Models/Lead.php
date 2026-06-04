<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'guest_report_id', 'email', 'name',
        'ip_address', 'consent_given', 'consent_text',
        'source',
    ];

    protected $casts = [
        'consent_given' => 'boolean',
    ];

    public function guestReport()
    {
        return $this->belongsTo(GuestReport::class);
    }
}
