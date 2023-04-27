<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthorArticleTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function test_get_authors_articles(): void
    {
        $author = Author::find(1);
        $page = 1;
        $response = $this->get("api/v1/authors/$author->slug/articles?=$page");
        $response->assertOk()
            ->assertJsonStructure([
                'data'
            ])->assertJson(
                fn(AssertableJson $json) =>
                $json->has('data', 4)
                    ->has('data.author')
                    ->has('data.articles',Article::PER_PAGE)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->where('data.author', $author->name)
                    ->etc()
            );
    }

    public function test_get_404_by_wrong_slug(): void
    {
        $wrongSlug = 'exactly_the_wrong_slug';
        $response = $this->get("api/v1/authors/$wrongSlug/articles");
        $response->assertNotFound();
    }
}
