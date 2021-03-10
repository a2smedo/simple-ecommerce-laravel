<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::orderBy('id', 'DESC')->paginate(6);
        $categories =  Category::select('id', 'name')->get();
        return view('admin.sub-categories.sub-categories', [
            'subcategories' => $subcategories,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'category_id' => $request->category_id,
        ]);

        $request->session()->flash('add', 'Row Add Successfly');
        return back();
    }



    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:subcategories,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
        ]);

       $subcategory =  Subcategory::findOrfail($request->id);

       $subcategory->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'category_id' => $request->category_id,
        ]);
        $request->session()->flash('update', 'Row Updated Successfly');

        return back();
    }

    public function delete(Request $request,  Subcategory $subcategory)
    {
        try {
            $subcategory->delete();
            $msg = "Row Deleted Successfly";
            $request->session()->flash('deleted', $msg);

        } catch (Exception $e) {
            $msg = "Can't Delete this Row";
            $request->session()->flash('no-deleted', $msg);
        };

        return back();
    }


    public function toggle(Subcategory $subcategory)
    {
        $subcategory->update([
            'active' => ! $subcategory->active
        ]);

        return back();
    }
}
