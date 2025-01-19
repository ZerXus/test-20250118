<?php

namespace App\Http\Resources;

use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ArticleTag */
class ArticleTagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'article_id' => $this->article_id,
            'tag_id' => $this->tag_id,

            'article' => new ArticleResource($this->whenLoaded('article')),
            'tag' => new TagResource($this->whenLoaded('tag')),
        ];
    }
}
