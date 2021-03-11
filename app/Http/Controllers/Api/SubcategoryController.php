<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $sub_categories =  SubcategoryResource::collection(Subcategory::get());

        if (! $sub_categories) {

            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => $sub_categories
        ]);
    }

    public function show(Request $request)
    {


        $sub_category = Subcategory::with('products')->find($request->id);

        if (! $sub_category) {
            return response()->json([
                'status' => false,
                'msg' => 'data not found',
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => new SubcategoryResource($sub_category)
        ]);
    }


}
