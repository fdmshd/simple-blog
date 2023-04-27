<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorArticleController;
use App\Http\Controllers\AuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('v1')->group(function () {
    Route::get('authors', [AuthorController::class, 'index']);

    Route::get('articles', [ArticleController::class, 'index']);

    Route::get('articles/{slug}', [ArticleController::class, 'show']);

    Route::get('authors/{authorSlug}/articles', [AuthorArticleController::class, 'index']);
});
