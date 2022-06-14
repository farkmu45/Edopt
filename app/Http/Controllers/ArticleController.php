<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function getAll(): ArticleCollection
    {
        return new ArticleCollection(Article::latest()->paginate(
            request('per_page', 5),
            ['id', 'admin_id', 'title', 'preview_text', 'image_url', 'created_at', 'updated_at']
        ));
    }

    public function getById(Article $article)
    {
        return new ArticleResource($article);
    }
}
