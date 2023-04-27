<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::paginate(Author::PER_PAGE);
        $collection = new AuthorCollection($authors);

        return response()
            ->json([
                'data' => $collection,
            ]);
    }
}
