<?php

namespace App\Http\Controllers\API\Question;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'question' => 'required',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        $question = Question::create($data);

        return response(['data' => $question]);
    }

    public function getAll()
    {
        $questions = Question::all();
        return response(['data' => $questions]);
    }
    public function get(Question $question)
    {
        return response(['data' => $question]);
    }

    public function getByUser(int $user)
    {
        $questions = DB::table('questions')
            ->where('user_id', $user)
            ->get();
        return response(['data' => $questions]);
    }

    public function getByCategory(int $category)
    {
        $questions = DB::table('questions')
            ->where('category_id', $category)
            ->get();
        return response(['data' => $questions]);
    }

}
