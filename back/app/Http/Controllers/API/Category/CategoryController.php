<?php

namespace App\Http\Controllers\API\Category;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => '',
        ]);
        $category = Category::create($data);
        return response(['data' => $category]);
    }

    public function getAll()
    {
        $categories = Category::all();
        return response(['data' => $categories]);
    }

    public function get(Category $category)
    {
        return response(['data' => $category]);
    }

}
