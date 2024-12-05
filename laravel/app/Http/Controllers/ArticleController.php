<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Article;

class ArticleController extends Controller
class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('article', compact('articles'));
    }
}
