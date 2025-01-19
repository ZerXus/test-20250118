<?php

namespace App\Http;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class CommentCreateJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        private readonly int    $articleId,
        private readonly string $commentTitle,
        private readonly string $commentDetail,
        private readonly string $userId
    ) {}

    public function handle(): void
    {
        sleep(60);
        Log::debug('test');
        Comment::create([
            'article_id' => $this->articleId,
            'title' => $this->commentTitle,
            'detail' => $this->commentDetail,
        ]);
    }
}
