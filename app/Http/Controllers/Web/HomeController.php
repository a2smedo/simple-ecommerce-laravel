<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::select("*")->orderBy("id", "DESC")->limit(12)->active()->get();
        return view('web.home.home',[
            'products' => $products,
        ]);
    }

    public function search(Request $request)
    {

        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->active()->get();

        foreach ($products as $product) {

          if (strtolower($request->search)) {
              return view('web.home.search', [
                  'searchProducts' => $products
              ]);
          }
        }

        return view('web.home.search');
    }
}
