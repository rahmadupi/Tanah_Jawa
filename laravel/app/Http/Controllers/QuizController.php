<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use App\Models\Score;

class QuizController extends Controller
{
    public function index()
    {
        return view('kuis');
    }
    public function score_store(Request $request)
{
    // Validate the request data
    $request->validate([
        'score' => 'required|integer',
        'last_take' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    Log::info('Score store request received', [
        'user_id' => $request->input('user_id'),
        'score' => $request->input('score'),
        'last_take' => $request->input('last_take')
    ]);

    // Find the existing score entry
    $existingScore = Score::where('user_id', $request->input('user_id'))->first();

    if ($existingScore) {
        // Add the new score to the existing score
        $existingScore->score += $request->input('score');
        $existingScore->last_take = $request->input('last_take');
        $existingScore->save();

        Log::info('Existing score updated', [
            'user_id' => $request->input('user_id'),
            'new_score' => $existingScore->score,
            'last_take' => $existingScore->last_take
        ]);
    } else {
        // Create a new score entry
        $newScore = Score::create([
            'user_id' => $request->input('user_id'),
            'score' => $request->input('score'),
            'last_take' => $request->input('last_take'),
        ]);

        Log::info('New score created', [
            'user_id' => $request->input('user_id'),
            'score' => $newScore->score,
            'last_take' => $newScore->last_take
        ]);
    }

    // Return a response
    return response()->json(['message' => 'Score added or updated successfully!'], 201);
}

    public function get_questions()
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
