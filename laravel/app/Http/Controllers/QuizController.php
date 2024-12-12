<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Score;

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
        $questions = Question::select('question', 'option1', 'option2', 'option3', 'option4', 'correct_index')
            ->inRandomOrder()
            ->limit(10)
            ->get()
            ->map(function ($question) {
                return [
                    'text' => $question->question,
                    'options' => [
                        $question->option1,
                        $question->option2,
                        $question->option3,
                        $question->option4,
                    ],
                    'correctIndex' => (int)$question->correct_index,
                ];
            });

        return response()->json($questions);
        // return 'test';
    }
}
