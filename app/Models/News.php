<?php

namespace App\Models;

use App\ExcerptsQuill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model {
    use ExcerptsQuill;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'user',
        'published_at',
        'status',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
