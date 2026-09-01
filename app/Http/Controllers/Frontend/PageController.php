<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct()
    {
        $categories = Category::where("status", true)->get();
        View::share([
            "categories" => $categories
        ]);
    }

    public function home()
    {
        $latest_article = Article::latest()->first();
        return view("frontend.home", compact("latest_article"));
    }

    public function category($slug)
    {
        $category = Category::where("slug", $slug)->where("status", true)->first();
        $advertises = Advertise::where("expiry_date", ">=", date("Y-m-d"))->get();
        return view("frontend.category", compact("category", "advertises"));
    }

    public function article($slug)
    {
        $article = Article::where("slug", $slug)->where("status", true)->first();
        $advertises = Advertise::where("expiry_date", ">=", date("Y-m-d"))->get();
        return view("frontend.article", compact("article", "advertises"));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $articles = Article::where("title", "like", "%$query%")->where("status", true)->get();
        $advertises = Advertise::where("expiry_date", ">=", date("Y-m-d"))->get();
        return view("frontend.search", compact("articles", "advertises", "query"));
    }
}
