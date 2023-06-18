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
//        print($query);
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
        $instructions = $data['instructions'] !== null ? $data['instructions'] : [];
        $answer = $data['answer'];
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
        return response(['data' => ['answer' => $answer,'instructions' => $instructions, 'popular_questions' => $popularQuestions]]);
    }

    public function test(){
        return response(json_decode('{
    "data": {
        "answer": "\n\nДля получения медицинского страхования Вам необходимо обратиться в любое страховое агентство или компанию, предоставляющую услуги по медицинскому страхованию. Вы также можете посетить веб-сайт любой из таких компаний и получить подробную информацию о предоставляемых программах медицинского страхования. Вы также можете позвонить в компанию и получить подробную информацию о предоставляемых программах медицинского страхования.",
        "instructions": [
            {
                "id": 30,
                "title": "Как получить Полис ОМС"
            },
            {
                "id": 26,
                "title": "Бесплатные медицинские услуги по Программе госсгарантий"
            },
            {
                "id": 56,
                "title": "Должностная инструкция специалиста первой категории по земельным, жилищным вопросам и муниципальной собственности"
            },
            {
                "id": 58,
                "title": "Должностная инструкция ведущего специалиста айыл окмоту по социальной защите"
            },
            {
                "id": 59,
                "title": "Кто может получать социальное пособие и как оформить пособие?"
            },
            {
                "id": 61,
                "title": "Пособие по беременности и родам"
            }
        ],
        "popular_questions": []
    }
}'));
    }
}
