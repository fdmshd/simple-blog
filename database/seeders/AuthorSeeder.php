<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Article;

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