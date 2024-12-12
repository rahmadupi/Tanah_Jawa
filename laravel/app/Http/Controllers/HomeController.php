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
        ->join('users', 'scores.user_id', '=', 'users.id')
        ->select('users.username', 'scores.score', 'scores.last_take')
        ->orderByDesc('scores.score')
        ->get();
        $articles = Article::orderBy('index', 'desc')->limit(3)->get();
        return view('home', compact('leaderboard', 'articles'));
    }
}
