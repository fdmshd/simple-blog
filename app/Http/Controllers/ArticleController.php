<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Article;


class ArticleController extends Controller
{
    private const PER_PAGE = 10;
    public function index(): JsonResponse
    {
        $articles = Article::paginate(self::PER_PAGE);
        $collection = ArticleResource::collection($articles);

        return response()
            ->json([
                'data' => $collection,
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage()
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