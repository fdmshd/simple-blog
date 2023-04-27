<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Author;

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