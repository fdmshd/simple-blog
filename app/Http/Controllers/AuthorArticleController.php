<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorArticleResource;
use App\Models\Author;

class AuthorArticleController extends Controller
{
    public function index($authorSlug)
    {
        $author = Author::where('slug', $authorSlug)->firstOrFail();

        $resource = new AuthorArticleResource($author);

        return $resource;
    }
}
