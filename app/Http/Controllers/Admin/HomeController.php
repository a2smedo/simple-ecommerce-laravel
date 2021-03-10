<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $data['orders'] = Order::count();
        $data['users'] = User::where('rule_id', 3)->count();

        $data['admins'] = User::whereIn('rule_id', [1,2])->count();

        $data['departments'] = Department::count();
        $data['categories'] = Category::count();
        $data['subcategories'] = Subcategory::count();
        $data['products'] = Product::count();

        //dd($data['users']);
        return view('admin.home.index')->with($data);
    }
}
