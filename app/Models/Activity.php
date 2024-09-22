<?php

namespace App\Models;

use App\Rules\NotEmptyContent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use nadar\quill\Lexer;

class Activity extends Model {
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'user',
        'published_at',
        'status',
        'medias',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'activity_tags');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // getDiff for human readable time
    public function getDiff(): string {
        return Carbon::parse($this->published_at)->diffForHumans();
    }


    public function getPublishedAtAttribute($value): string {
        return Carbon::parse($value)->format('d F Y');
    }


    public function render(): string {
        $validator = new NotEmptyContent();
        if ($validator->validate($this->content, null, function () {
        })) {
            return '';
        }
        $lexer = new Lexer($this->content);
        return $lexer->render();
    }

    public function getExcerpt($limit  = 100): string {
        $formattedContent = $this->render();
        preg_match('/<p>(.*?)<\/p>/', $formattedContent, $matches);
        $firstParagraph = $matches[0] ?? '';
        return substr(strip_tags($firstParagraph), 0, $limit) . '...';
    }
}
