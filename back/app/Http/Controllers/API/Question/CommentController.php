<?php

namespace App\Http\Controllers\API\Question;

use App\Models\Question;
use App\Models\QuestionComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => '',
            'question_id' => '',
            'comment' => ''
        ]);
        $user = DB::table('users')->where('id', $data['user_id'])->get()[0];
        if($user->role != 'ROLE_LAWYER'){
            return response(['error' => 'only LAWYERS can comment'])->setStatusCode(403);
        }
        $comment = QuestionComment::create($data);
        return response(['data' => $comment]);

    }

    public function getByQuestion(Question $question)
    {
        $comments = DB::table('question_comments')
            ->where('question_id', $question->id)
            ->get();
        return response(['data' => $comments]);
    }
}
