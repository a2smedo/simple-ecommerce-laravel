<?php

namespace App\Http\Controllers\Web;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(Product $product)
    {
        return view('web.review-rate.review-rate', [
            'product' => $product,

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

      $request->session()->flash('add-rev', "Your Review and Rating Added Successfly");

      return redirect(url('products/show/' . $product->id));


    }

}
