<?php

namespace App\Http\Controllers\Web;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // all products methods
    public function index()
    {
        $data['allProducts'] = Product::select('*')->active()->paginate(12);
        return view('web.products.index')->with($data);
    }

    public function mostPopular()
    {
        $data['mostPopulars'] = Product::select('*')->where('reviews', '>', 0)->active()->paginate(12);
        return view('web.products.most-popular')->with($data);
    }

    public function newIn()
    {
        $data['newInProducts'] = Product::select('*')->where('id', '>', 20)->orderBy('id', 'DESC')->active()->paginate(12);
        return view('web.products.new-products')->with($data);
    }

    public function lowPrice()
    {
        $data['lowPriceProducts'] = Product::select('*')->where('price', '<', 4000)->orderBy('price')->active()->paginate(12);
        return view('web.products.low-price')->with($data);
    }

    public function hightPrice()
    {
        $data['hightPriceProducts'] = Product::select('*')->where('price', '>', 4000)->orderBy('price', 'DESC')->active()->paginate(12);
        return view('web.products.hight-price')->with($data);
    }


    //single product
    public function showProduct(Product $product)
    {
        $data['product'] = $product;
        $data['reviews'] = Review::where('product_id', $product->id)->get();
        return view('web.products.show')->with($data);
    }


}
