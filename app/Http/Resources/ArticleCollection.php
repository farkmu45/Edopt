<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($article) => [
                'id' => $article->id,
                'admin_name' => $article->admin->name,
                'text_preview' => $article->text_preview,
                'content' => $article->content,
                'image_url' => $article->image_url,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at
            ]
        );
    }
}
