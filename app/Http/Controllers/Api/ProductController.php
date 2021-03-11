<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products =  ProductResource::collection(Product::get());

        if (! $products) {

            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => $products
        ]);
    }

    public function show(Request $request)
    {


        $product = Product::find($request->id);

        if (! $product) {
            return response()->json([
                'status' => false,
                'msg' => 'data not found',
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => new ProductResource($product)
        ]);
    }


    public function most_popular()
    {

        $productMostPoupler = Product::where('reviews', '>', 0)->active()->get();

        $products =  ProductResource::collection($productMostPoupler);

        if (! $products) {

            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => $products
        ]);
    }


    public function new_products()
    {

        $newProducts = Product::where('id', '>', 20)->orderBy('id', 'DESC')->active()->get();

        $products =  ProductResource::collection($newProducts);

        if (! $products) {

            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => $products
        ]);
    }


    public function low_price()
    {

        $lowPrice = Product::where('price', '<=', 2500)->active()->get();

        $products =  ProductResource::collection($lowPrice);

        if (! $products) {

            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => $products
        ]);
    }

    public function hight_price()
    {

        $hightPrice = Product::where('price', '>=', 2501)->active()->get();

        $products =  ProductResource::collection($hightPrice);

        if (! $products) {

            return response()->json([
                'status' => false,
                'msg' => 'fail',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'success',
            'data' => $products
        ]);
    }



    public function storeReview(Request $request, Product $product, Review $review)
    {
      $request->validate([
        'review' => 'required|string',
        'rating' => 'required',
      ]);


      $user = Auth::user();

      $reviews = Review::select('*')->where('user_id', $user->id)->where('product_id', $product->id)->get();

      $reviews_array = $reviews->toArray();

      if (empty($reviews_array)) {

        $review->create([
          'user_id' => $user->id,
          'product_id' => $product->id,
          'name' => $user->name,
          'review' => $request->review,
          'rating' => $request->rating,
        ]);
      } else {

        foreach ($reviews_array as $val) {
          if ($val['product_id'] !== $product->id) {
            $review->create([
              'user_id' => $user->id,
              'product_id' => $product->id,
              'name' => $user->name,
              'review' => $request->review,
              'rating' => $request->rating,
            ]);
          } else {

            DB::table('reviews')->where('user_id', $user->id)->where('product_id', $product->id)->update([
              'review' => $request->review,
              'rating' => $request->rating,
            ]);
          }
        }
      }


      $product_reviews =  DB::table('reviews')
        ->select(array('product_id', DB::raw('COUNT(review) as review'), DB::raw('AVG(rating) as rating')))
        ->where('product_id', $product->id)->groupBy('product_id')->get();

      foreach ($product_reviews as $rev) {

        if ($product->id == $rev->product_id) {
          DB::table('products')->where('id', $rev->product_id)->update([
            'reviews' => $rev->review,
            'rating' => $rev->rating
          ]);
        }
      }

      return response()->json(['msg' => 'Reviews and Rating addedd successfluy']);

    }

}
