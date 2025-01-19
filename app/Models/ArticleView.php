<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleView extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'article_id',
        'views',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
