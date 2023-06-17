<?php

namespace App\Http\Controllers\API\Instruction;

use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructionController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'instruction' => 'required',
            'category_id' => 'required',
        ]);
        $instruction = Instruction::create($data);
        return response(['data' => $instruction]);
    }

    public function getAll()
    {
        $instructions = Instruction::all();
        return response(['data' => $instructions]);
    }

    public function get(Instruction $instruction)
    {
        return response(['data' => $instruction]);
    }

    public function getByCategory(int $category)
    {
        $instructions = DB::table('instructions')
            ->where('category_id', $category)
            ->get();
        return response(['data' => $instructions]);
    }

    public function document($instruction)
    {
        $document = DB::table('instructions')->select('title','instruction')
            ->where('id', $instruction)
            ->get();
        $document = $document[0];
        return view('instruction', compact('document'));
    }
}
