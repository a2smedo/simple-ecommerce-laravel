<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =  CategoryResource::collection(Category::get());

        
        if (! $categories) {
            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'msg' => 'Success',
            'data' => $categories
        ]);
    }

    public function show(Request $request)
    {

        $category = Category::with('subcategories')->find($request->id);

        if (! $category) {
            return response()->json([
                'status' => false,
                'msg' => 'data not found',
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' =>new CategoryResource($category)
        ]);
    }
}
