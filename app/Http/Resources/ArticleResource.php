<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'admin_name' => $this->admin->name,
            'title' => $this->title,
            'preview_text' => $this->preview_text,
            'content' => $this->content,
            'image_url' => asset('/storage/' . $this->image_url),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
