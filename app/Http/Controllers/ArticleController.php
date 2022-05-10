<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getAll(): ArticleCollection
    {
        return new ArticleCollection(Article::paginate(5));
    }

    public function getById(Article $article)
    {
        return new ArticleResource($article);
    }
}
