<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Article */
class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'detail' => $this->detail,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'views' => $this->views->views,
            'tags' => $this->tags,
            'likes' => $this->likes()->count(),
            'comments' => $this->comments,
            'is_liked' => $this->likes()->where('user_id', $request->user()->id)->exists()
        ];
    }
}
