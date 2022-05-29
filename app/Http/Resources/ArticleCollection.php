<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($article) => [
                'id' => $article->id,
                'admin_name' => $article->admin->name,
                'title' => $article->title,
                'preview_text' => $article->preview_text,
                'image_url' => asset($article->image_url),
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at
            ]
        );
    }
}
