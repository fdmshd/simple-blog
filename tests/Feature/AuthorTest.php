<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    /**
     * @test
     */
    public function get_authors(): void
    {
        $page = 1;
        $response = $this->get("api/v1/authors?page={$page}");
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ])->assertJson(
                fn (AssertableJson $json) => $json->has('data', 3)
                    ->has('data.authors', 10)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->etc()
            );
    }

    /**
     * @test
     */
    public function dont_get_authors_if_page_is_wrong(): void
    {
        $page = 2;
        $response = $this->get("api/v1/authors?page={$page}");
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ])->assertJson(
                fn (AssertableJson $json) => $json->has('data', 3)
                    ->has('data.authors', 0)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->etc()
            );
    }
}
