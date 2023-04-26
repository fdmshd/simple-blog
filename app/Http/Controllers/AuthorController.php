<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    private const PER_PAGE = 10;
    public function index(): JsonResponse
    {
        $authors = Author::paginate(self::PER_PAGE);
        $collection = AuthorResource::collection($authors);

        return response()
            ->json([
                'data' => $collection->all(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage()
            ]);
    }

}