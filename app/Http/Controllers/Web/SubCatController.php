<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCatController extends Controller
{
    public function show(Subcategory $subcategory)
    {
        $data['subcategory'] = $subcategory;
        $data['subcategory_products'] = $subcategory->products()->active()->paginate(8);

        return view('web.subcategory.show')->with($data);
    }
}
