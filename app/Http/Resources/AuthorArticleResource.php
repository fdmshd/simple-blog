<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $articleCollection = ShortArticleResource::collection(
            Article::where('author_id', $this->id)
                ->paginate(Article::PER_PAGE)
        );

        return [
            'author' => $this->name,
            'articles' => $articleCollection,
            'current_page' => $articleCollection->currentPage(),
            'last_page' => $articleCollection->lastPage(),
        ];
    }
}
