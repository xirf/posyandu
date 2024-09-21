<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use nadar\quill\Lexer;
use Illuminate\Support\Carbon;

class News extends Model {

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

    public function getPublishedAtAttribute($value): string {
        return Carbon::parse($value)->format('d F Y');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getFormatted(): string {
        $lexer = new Lexer($this->content);
        return $lexer->render();
    }

    public function getExcerpt($limit  = 100): string {
        $formattedContent = $this->getFormatted();
        preg_match('/<p>(.*?)<\/p>/', $formattedContent, $matches);
        $firstParagraph = $matches[0] ?? '';
        return substr(strip_tags($firstParagraph), 0, $limit) . '...';
    }
}
