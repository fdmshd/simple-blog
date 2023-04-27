<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articlesCount = rand(20, 30);
        Author::factory()
            ->count(10)
            ->has(Article::factory()->count($articlesCount))
            ->create();
    }
}
