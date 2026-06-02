<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'url', 'domain', 'industry',
        'overall_score', 'category_scores', 'recommendations',
        'pdf_path', 'is_public',
    ];

    protected $casts = [
        'category_scores' => 'array',
        'recommendations' => 'array',
        'is_public' => 'boolean',
        'overall_score' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
