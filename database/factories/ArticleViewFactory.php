<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ArticleViewFactory extends Factory
{
    protected $model = ArticleView::class;

    public function definition(): array
    {
        return [
            'views' => 1 + $this->faker->randomDigit() * 33,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'article_id' => Article::factory(),
        ];
    }
}
