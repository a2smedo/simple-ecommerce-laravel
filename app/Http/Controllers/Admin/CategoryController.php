<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(6);
        $departments =  Department::select('id', 'name')->get();
        
        return view('admin.categories.categories', [
            'categories' => $categories,
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'department_id' => 'required|exists:departments,id',
        ]);

        Category::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'department_id' => $request->department_id,
        ]);

        $request->session()->flash('add', 'Row Add Successfly');
        return back();
    }



    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'department_id' => 'required|exists:departments,id',
        ]);

        $category =  Category::findOrfail($request->id);

       $category->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'department_id' => $request->department_id,
        ]);
        $request->session()->flash('update', 'Row Updated Successfly');

        return back();
    }

    public function delete(Request $request,  Category $category)
    {
        try {
            $category->delete();
            $msg = "Row Deleted Successfly";
            $request->session()->flash('deleted', $msg);

        } catch (Exception $e) {
            $msg = "Can't Delete this Row";
            $request->session()->flash('no-deleted', $msg);
        };

        return back();
    }


    public function toggle(Category $category)
    {
        $category->update([
            'active' => ! $category->active
        ]);

        return back();
    }
}
