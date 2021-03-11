<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;

class WishListController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        $wishlist =  Wishlist::where('user_id', $user->id)->orderBy('id')->get();
        $wishlists =  WishlistResource::collection($wishlist);


        if (empty($wishlists)) {
            return response()->json([
                'msg' => 'no data found',
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'msg' => 'success',
            'wishlists' => $wishlists
        ]);
    }


    public function store(Product $product, Wishlist $wishlist, Request $request)
    {
        $userId = $request->user()->id;

        $x = $wishlist->where('user_id', $userId)->where('product_id', $product->id)->get();

        if ($userId !== null) {

            if ($x->isEmpty()) {

                $wishlist->create([
                    'user_id' => $userId,
                    'product_id' => $product->id
                ]);


                return response()->json([
                    'msg' => 'This product Added in Wishlist Successfly',
                ]);

           ;
            } else {

                return response()->json([
                    'msg' => 'This product alraedy exists in your Wishlist',
                ]);


            }
        }

        return back();
    }



    public function delete(Request $request, Wishlist $wishlist, Product $product)
    {
        $user = $request->user();

        if ($user) {

            $wishlist->where('product_id', $product->id)->delete();
        }

        return response()->json([
            'msg' => 'This product deleted Successfly',
        ]);
    }
}
