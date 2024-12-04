<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $artikels = Article::all();
        return view('article.index', compact('article'));
    }
}
