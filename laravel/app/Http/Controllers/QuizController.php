<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\score;

class QuizController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'score' => 'required|integer',
            'last_take' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new score entry
        Score::create([
            'score' => $request->input('score'),
            'last_take' => $request->input('last_take'),
            'user_id' => $request->input('user_id'),
        ]);

        // Return a response
        return response()->json(['message' => 'Score added successfully!'], 201);
    }
}
