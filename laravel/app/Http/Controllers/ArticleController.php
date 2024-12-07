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

    public function show(Request $request)
    {
        // Get the ID from the request
        $id = $request->input('id');
        \Log::info('Article ID: ' . $id);

        // Query the database based on the item ID
        $article = Article::findOrFail($id);

        // Pass the article data to the view
        return view('konten', compact('article'));
    }
}
