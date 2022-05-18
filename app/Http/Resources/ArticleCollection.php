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
                'text_preview' => $article->text_preview,
                'image_url' => $article->image_url,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at
            ]
        );
    }
}
