<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function latest_article()
    {
        $latest_article = Article::latest()->first();
        return new ArticleResource($latest_article);
    }

    public function article($slug)
    {
        $article = Article::where("slug", $slug)->where("status", true)->first();
        return new ArticleResource($article);
    }
}
