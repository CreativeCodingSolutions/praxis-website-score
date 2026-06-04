<?php

namespace App\Modules\LeadCapture\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = [
        'name', 'email', 'website_url', 'score', 'status',
        'guest_report_id', 'ip_address', 'consent_given', 'consent_text', 'source',
    ];

    protected $casts = [
        'score' => 'integer',
        'consent_given' => 'boolean',
    ];
}
