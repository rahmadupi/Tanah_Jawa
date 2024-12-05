<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\score;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $leaderboard = score::query()
        -> ORDERBY ('score', 'DESC')
        -> LIMIT (5)
        ->get();

        $articles = Article::orderBy('index', 'desc')->limit(3)->get();

        return view('home', compact('leaderboard','articles'));
        // return view('home', compact('articles'));
    }
}
