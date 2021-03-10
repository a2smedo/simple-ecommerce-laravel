<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
        $superAdminRule = Rule::where("name", "superadmin")->first();
        $adminRule = Rule::where("name", "admin")->first();
        $data['admins'] = User::whereIn("rule_id", [$superAdminRule->id, $adminRule->id])
                            ->orderBy('id', 'Desc')
                            ->paginate(10);

        return view('admin.admins.index')->with($data);
    }

    public function create()
    {
        $data['rules'] = Rule::select("id", "name")
                        ->whereIn("name", ["superadmin", "admin"])
                        ->get();
        return view('admin.admins.create')->with($data);

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:3|max:255|confirmed',
            'rule_id' => 'required|exists:rules,id',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required|string',

        ]);

      $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rule_id' => $request->rule_id,
            'country' => $request->country,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        //verifed manule
        event(new Registered($user));

        return redirect(url("/dashboard/admins"));
    }


    public function promot($id)
    {
        $admin = User::findOrfail($id);
        $admin->update([
            'rule_id' => Rule::select("id")->where("name", "superadmin")->first()->id,
        ]);

        return back();
    }

    public function demot($id)
    {
        $superAdmin = User::findOrfail($id);
        $superAdmin->update([
            'rule_id' => Rule::select("id")->where("name", "admin")->first()->id,
        ]);

        return back();

    }


    public function delete($id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        return back();
    }
}
