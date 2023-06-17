<?php

namespace App\Http\Controllers\API\Question;

use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'question_id' => 'required'
        ]);

        $like = QuestionLike::create($data);
        return response(['data' => $like]);
    }

    public function getAll()
    {
        $likes = QuestionLike::all();
        return response(['data' => $likes]);
    }
    public function get(QuestionLike $like)
    {
        return response(['data' => $like]);
    }
    public function getByQuestion(int $question, int $user)
    {

        $likes = DB::table('question_likes')
            ->where('question_id', $question)
            ->get();
        $is_liked = false;
        foreach ($likes as $like)
        {
            if($like->user_id == $user) $is_liked = true;
        }
        return response(['data' => ['count' => count($likes), 'is_liked' => $is_liked]]);
    }
    public function delete(Request $request){
        $data = $request->validate([
            'user_id' => '',
            'question_id' => ''
        ]);
        DB::table('question_likes')
            ->where('user_id', $data['user_id'])
            ->where('question_id', $data['question_id'])
            ->delete();

        return response(['data' => 'OK']);
    }

}
