<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes, hasFactory;
    const string COLUMN_TITLE = 'title';
    const string COLUMN_DETAIL = 'detail';
    const string COLUMN_USER = 'user_id';
    protected $fillable = [
        'title',
        'detail',
    ];

    public function views(): HasOne
    {
        return $this->hasOne(ArticleView::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'article_tags');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
