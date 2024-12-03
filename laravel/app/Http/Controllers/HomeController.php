<?php

namespace App\Http\Controllers;

use App\Models\score;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $leaderboard = score::query()
        -> ORDERBY ('score', 'DESC')
        -> LIMIT (5);
        return view('home', compact('leaderboard'));
    }
}
