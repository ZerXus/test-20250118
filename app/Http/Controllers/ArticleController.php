<?php

namespace App\Http\Controllers;

use App\Http\CommentCreateJob;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticleController
{
    public function index()
    {
        return ArticleResource::collection(Article::all());
    }

    public function scopeLifo(Builder $query): void
    {
        $query->orderBy('id', 'desc');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'detail' => ['required'],
        ]);

        return new ArticleResource(Article::create($data));
    }

    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required'],
            'detail' => ['required'],
        ]);

        $article->update($data);

        return new ArticleResource($article);
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json();
    }

    public function newest(Request $request)
    {
        return ArticleResource::collection(Article::orderByDesc('created_at')->limit(6)->get());
    }

    public function like(Request $request, Article $article)
    {
        if ($article->likes()->where('user_id', $request->user()->id)->exists()) {
            $article->likes()->where('user_id', $request->user()->id)->delete();
            return response()->json();
        }

        $article->likes()->create(['user_id' => $request->user()->id]);
        return response()->json();
    }

    public function comment(Request $request, Article $article)
    {
        CommentCreateJob::dispatch(
            $article->id,
            $request->input('title'),
            $request->input('detail'),
            $request->user()->id
        );
        return response()->json();
    }
}
