<?php

// database/migrations/create_news_tags_table.php

use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreateNewsTagsTable extends Model {
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
