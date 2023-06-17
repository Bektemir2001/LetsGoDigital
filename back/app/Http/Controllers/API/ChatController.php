<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ChatController
{
    public function query(Request $request)
    {
        $query = $request->input('query');
        $instructions = DB::table('instructions')
            ->select('id', 'title')->get();
//        return response(['data' => $query, 'instruction' => $instructions]);
        $response = Http::post('http://192.168.43.93:8080/api/whichCategory', [
            'question' => $query,
            'instructions' => $instructions,
        ]);
        $data = [];
        if ($response->successful()) {
            $data = $response->json();
            // Process the response data
        }
//        return response(['data' => $data]);
        $instructions = $data;
        $categories = [];
        for($i = 0; $i < count($instructions); $i++)
        {
            $instruction = $instructions[$i];
            $category = DB::table('instructions')
                ->where('id', $instruction['id'])
                ->get()[0];
            if(!array_search($category->category_id, $categories))
            {
                array_push($categories, $category->category_id);
            }
        }

        $popularQuestions = DB::table('questions as q')
            ->join('question_likes as l', 'q.id', '=', 'l.question_id')
            ->select('q.id', 'q.category_id', 'q.question', DB::raw('COUNT(l.id) as total_likes'))
            ->whereIn('category_id', $categories)
            ->groupBy('q.id', 'q.question')
            ->orderByDesc('total_likes')
            ->limit(4)
            ->get();
        return response(['data' => ['instructions' => $data, 'popular_questions' => $popularQuestions]]);
    }
}
