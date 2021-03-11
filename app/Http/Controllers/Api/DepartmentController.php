<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments =  DepartmentResource::collection(Department::get());
        if (! $departments) {
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
            'data' => $departments
        ]);
    }

    public function show(Request $request)
    {

        $department = Department::with('categories')->find($request->id);

        if (! $department) {
            return response()->json([
                'status' => false,
                'msg' => 'data not found',
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' =>new DepartmentResource($department)
        ]);
    }
}
