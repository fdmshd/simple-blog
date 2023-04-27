<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    /**
     * @test
     */
    public function get_articles(): void
    {
        $page = 2;
        $response = $this->get("api/v1/articles?page={$page}");
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ])->assertJson(
                fn (AssertableJson $json) => $json->has('data', 3)
                    ->has('data.articles', Article::PER_PAGE)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->etc()
            );
    }

    /**
     * @test
     */
    public function dont_get_articles_if_page_is_wrong(): void
    {
        $page = 123;
        $response = $this->get("api/v1/articles?page={$page}");
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ])->assertJson(
                fn (AssertableJson $json) => $json->has('data', 3)
                    ->has('data.articles', 0)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->etc()
            );
    }

    /**
     * @test
     */
    public function get_article_by_slug(): void
    {
        $article = Article::find(1);
        $response = $this->get("api/v1/articles/{$article->slug}");
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ])->assertJson(
                fn (AssertableJson $json) => $json->has('data', 5)
                    ->has('data.name')
                    ->has('data.slug')
                    ->has('data.description')
                    ->has('data.author')
                    ->has('data.publication_date')
                    ->where('data.name', $article->name)
                    ->where('data.slug', $article->slug)
                    ->where('data.description', $article->description)
                    ->where('data.author', $article->author->name)
                    ->where('data.publication_date', $article->created_at->format('d.m.Y H:i'))
                    ->etc()
            );
    }

    /**
     * @test
     */
    public function get_404_by_wrong_slug(): void
    {
        $wrongSlug = 'exactly_the_wrong_slug';
        $response = $this->get("api/v1/articles/{$wrongSlug}");
        $response->assertNotFound();
    }
}
