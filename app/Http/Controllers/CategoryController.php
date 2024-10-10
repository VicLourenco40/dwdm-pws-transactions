<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->title = $request->title;

        $category->save();

        return response()->json([
            'message' => 'Category added successfully',
            'category' => $category
        ]);
    }
}