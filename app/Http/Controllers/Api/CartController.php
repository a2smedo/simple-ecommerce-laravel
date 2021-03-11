<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $user = Auth::user();

        if ($user !== null) {
            $cart_user = Cart::where('user_id', $user->id)->get();
            $carts = CartResource::collection($cart_user);
            if ($carts->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => "No found Products's",
                    'data' => []
                ]);
            } else {

                $userTotalprices = DB::table('carts')->select(DB::raw('SUM(price * quantity) as price'))->where('user_id', $user->id)->groupBy('user_id')->first();

                $totalPrice = 0;
                if (!empty($userTotalprices)) {
                    foreach ($userTotalprices as $price) {
                        $totalPrice = $price;
                    }
                }

                return response()->json([
                    'data' => $carts,
                    'total_price' => $totalPrice
                ]);
            }
        }
    }


    public function addToCart(Request $request, Product $product)
    {
        $user = $request->user();

        if ($user !== null) {

            $discount = ($product->price * $product->discount) / 100;
            $newPrice = $product->price - $discount;
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'img' => $product->img,
                'price' => $newPrice,
            ]);

            return response()->json([
                'msg' => "This's Products Addedd Successfly",
            ]);
        }
    }


    public function update(Request $request, Cart $cart , Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $user = $request->user();

        if ($user !== null) {

            $cart->where('user_id', $user->id)->where('product_id', $product->id)->update([
                'quantity' => $request->quantity,
            ]);

            return response()->json([
                'msg' => "This's Products Updated Successfly",
            ]);
        }
    }

    public function remove(Cart $cart , Product $product)
    {

        $user = Auth::user();

        if ($user !== null) {
            $cart->where('product_id', $product->id)->delete();
            return response()->json([
                'msg' => "This's Products Deleted Successfly",
            ]);
        }

    }

}
