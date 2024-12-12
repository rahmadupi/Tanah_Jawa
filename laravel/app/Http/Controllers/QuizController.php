<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\score;

class QuizController extends Controller
{
    public function index()
    {
        return view('kuis');
    }
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

    public function getQuestions()
    {
        // Query the database for questions
        $questions = DB::table('questions')
            ->select('question', 'Option1', 'Option2', 'Option3', 'Option4', 'correct_index')
            ->inRandomOrder()
            ->limit(10)
            ->get()
            ->map(function ($question) {
                return [
                    'text' => $question->text,
                    'options' => [
                        $question->Option1,
                        $question->Option2,
                        $question->Option3,
                        $question->Option4,
                    ],
                    'correctIndex' => (int)$question->correct_index,
                ];
            });

        // Return the questions as a JSON response
        return response()->json($questions);
    }
}
