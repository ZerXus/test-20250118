<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            Article::COLUMN_TITLE => $this->faker->words(3, true),
            Article::COLUMN_DETAIL => $this->faker->text(500),
            Article::COLUMN_USER => User::first(),
        ];
    }
}
