<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Article::paginate(Article::PER_PAGE);
        $collection = new ArticleCollection($articles);

        return response()
            ->json([
                'data' => $collection,
            ]);
    }

    public function show($slug): JsonResponse
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $articleResourse = new ArticleResource($article);

        return response()
            ->json([
                'data' => $articleResourse,
            ]);
    }
}
