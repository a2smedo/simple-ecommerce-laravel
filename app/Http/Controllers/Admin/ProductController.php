<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(6);
        // $subCats =  Subcategory::select('id', 'name')->get();
        return view('admin.products.index', [
            'products' => $products,
            // 'subCats' => $subCats,
        ]);
    }


    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    public function create()
    {
        $subCats =  Subcategory::select('id', 'name')->get();
        return view('admin.products.create', [
            'subCats' => $subCats,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'descEn' => 'required|string',
            'descAr' => 'required|string',
            'img' => 'required|image|max:2048',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'discount' => 'required|integer|min:1',
        ]);





        $path = Storage::putFile("products", $request->file('img'));

        Product::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),

            'desc' => json_encode([
                'en' => $request->descEn,
                'ar' => $request->descAr,
            ]),
            'img' => $path,
            'subcategory_id' => $request->subcategory_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'reviews' => 0,
            'rating' => 0,
            'active' => 0,
        ]);

        $request->session()->flash('add', 'Row Add Successfly');
        return redirect(url("/dashboard/products"));
    }


    public function edit(Product $product)
    {
        $subCats =  Subcategory::select('id', 'name')->get();
        return view('admin.products.edit', [
            'product' => $product,
            'subCats' => $subCats,
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'descEn' => 'required|string',
            'descAr' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'discount' => 'required|integer|min:1',
        ]);



        $path = $product->img;

        if ($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile("products", $request->file('img'));
        }


        $product->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),

            'desc' => json_encode([
                'en' => $request->descEn,
                'ar' => $request->descAr,
            ]),
            'img' => $path,
            'subcategory_id' => $request->subcategory_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
        ]);


        $request->session()->flash('update', 'Row Updated Successfly');
        return redirect(url("/dashboard/products"));
    }




    public function delete(Request $request,  Product $product)
    {
        try {
            $path = $product->img;

            $product->delete();
            Storage::delete($path);

            $msg = "Row Deleted Successfly";
            $request->session()->flash('deleted', $msg);

        } catch (Exception $e) {
            $msg = "Can't Delete this Row";
            $request->session()->flash('no-deleted', $msg);
        };

        return back();
    }


    public function toggle(Product $product)
    {
        $product->update([
            'active' => !$product->active
        ]);

        return back();
    }
}
