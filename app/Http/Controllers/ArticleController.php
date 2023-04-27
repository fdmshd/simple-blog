<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ShortArticleCollection;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(Article::PER_PAGE);
        $collection = new ShortArticleCollection($articles);

        return response()->json($collection);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $articleResourse = new ArticleResource($article);

        return $articleResourse;
    }
}
