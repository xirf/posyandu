<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model {
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'content',
        'user',
        'published_at',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    // status is enum
    public const STATUS = [
        'draft',
        'published'
    ];

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
