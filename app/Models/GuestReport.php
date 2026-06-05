<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestReport extends Model
{
    protected $fillable = [
        'uuid', 'url', 'domain', 'industry',
        'overall_score', 'category_scores', 'recommendations',
        'ip_address', 'lead_captured',
    ];

    protected $casts = [
        'category_scores' => 'array',
        'recommendations' => 'array',
        'overall_score' => 'integer',
        'lead_captured' => 'integer',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
