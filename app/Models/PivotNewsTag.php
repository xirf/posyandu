<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotNewsTag extends Model {
    protected $fillable = [
        'news_id',
        'tag_id',
    ];


    public function news(): BelongsTo {
        return $this->belongsTo(News::class);
    }

    public function tag(): BelongsTo {
        return $this->belongsTo(Tag::class);
    }
}
