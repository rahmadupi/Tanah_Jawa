<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('index', 'desc')->get();
        return view('article', compact('articles'));
    }

    public function show($id)
    {
        // Validate the ID
        if (!is_numeric($id) || !Article::where('index', $id)->exists()) {
            abort(404);
        }

        // Query the database for the article
        $article = Article::findOrFail($id);

        // Pass the article data to the view
        return view('konten', compact('article'));
    }
}
