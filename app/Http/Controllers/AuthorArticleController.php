<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorArticleCollection;
use App\Http\Resources\AuthorArticleResource;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Article;

class AuthorArticleController extends Controller
{
    private const PER_PAGE = 10;
    public function index($authorSlug)
    {
        $author = Author::where('slug', $authorSlug)->firstOrFail();
        
        $resource = new AuthorArticleResource($author);

        return response()
            ->json(
                $resource,
            );
    }
}