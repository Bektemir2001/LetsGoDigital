<?php

namespace App\Http\Controllers\API;

use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PetitionController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => '',
            'description' => '',
            'photo' => '',
            'user_id' => ''
        ]);
        $photo = Storage::disk('public')->put('images', $request->file('photo'));

        $petition = Petition::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'photo' => $photo,
            'user_id' => $data['user_id']
        ]);

        return response(['data' => $petition]);
    }

    public function getAll(){
        $petitions = DB::table('petitions')
            ->orderByDesc('created_at')
            ->get();
        return response(['data' => $petitions]);

    }

    public function get(Petition $petition)
    {
        return response(['data' => $petition]);
    }
}
