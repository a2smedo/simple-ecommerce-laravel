<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'DESC')->paginate(6);
        return view('admin.department.departments', ['departments' => $departments]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
        ]);

        Department::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ])
        ]);

        $request->session()->flash('add', 'Row Add Successfly');
        return back();
    }



    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:departments,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
        ]);

        Department::findOrfail($request->id)->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
        ]);
        $request->session()->flash('update', 'Row Updated Successfly');

        return back();
    }

    public function delete(Request $request,  Department $department)
    {
        try {
            $department->delete();
            $msg = "Row Deleted Successfly";
            $request->session()->flash('deleted', $msg);

        } catch (Exception $e) {
            $msg = "Can't Delete this Row";
            $request->session()->flash('no-deleted', $msg);
        };

        return back();
    }


    public function toggle(Department $department)
    {
        $department->update([
            'active' => ! $department->active
        ]);

        return back();
    }
}
