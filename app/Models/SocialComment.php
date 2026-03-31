<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialComment extends Model
{
    use HasUuids;

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
        'parent_id',
        'is_flagged',
    ];

    protected $casts = [
        'is_flagged' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(SocialPost::class, 'post_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(SocialComment::class, 'parent_id');
    }
}
