<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_get_authors(): void
    {
        $page = 1;
        $response = $this->get("api/v1/authors?page=$page");
        $response->assertOk()
            ->assertJsonStructure([
                'data'
            ])->assertJson(
                fn(AssertableJson $json) =>
                $json->has('data', 3)
                    ->has('data.authors', 10)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->etc()
            );
    }

    public function test_dont_get_authors_if_page_is_wrong(): void
    {
        $page = 2;
        $response = $this->get("api/v1/authors?page=$page");
        $response->assertOk()
            ->assertJsonStructure([
                'data'
            ])->assertJson(
                fn(AssertableJson $json) =>
                $json->has('data', 3)
                    ->has('data.authors', 0)
                    ->has('data.current_page')
                    ->has('data.last_page')
                    ->where('data.current_page', $page)
                    ->etc()
            );
    }
}