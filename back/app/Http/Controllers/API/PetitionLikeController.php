<?php

namespace App\Http\Controllers\API;



use App\Models\PetitionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetitionLikeController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => '',
            'petition_id' => ''
        ]);

        $like = PetitionLike::create($data);
        return response(['data' => $like]);
    }
    public function getByPetition(int $petition, int $user)
    {

        $likes = DB::table('petition_likes')
            ->where('petition_id', $petition)
            ->get();
        $is_liked = false;
        foreach ($likes as $like)
        {
            if($like->user_id == $user) $is_liked = true;
        }
        return response(['data' => ['count' => count($likes), 'is_liked' => $is_liked]]);
    }
}
