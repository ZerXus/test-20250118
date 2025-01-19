<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $tags = Tag::factory()->count(30)->create();
        Article::factory()->count(5)
            ->has(ArticleView::factory(), 'views')
            ->hasAttached(
                $tags->random(3),
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                'tags'
            )
            ->create();
    }
}
