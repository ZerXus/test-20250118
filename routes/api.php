<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/modules.php';

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::get('article/newest', [ArticleController::class, 'newest']);
    Route::get('article/{article}', [ArticleController::class, 'show']);
    Route::post('article/{article}/comment', [ArticleController::class, 'comment']);
    Route::post('article/{article}/like', [ArticleController::class, 'like']);
});
