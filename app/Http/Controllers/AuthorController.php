<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(Author::PER_PAGE);
        $collection = new AuthorCollection($authors);

        return response()->json($collection);
    }
}
