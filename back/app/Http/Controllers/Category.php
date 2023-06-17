<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class Category
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => '',
            'category_id' => ''
        ]);
        $category = Category::create($data);
        return response(['data' => $category]);
    }

}
