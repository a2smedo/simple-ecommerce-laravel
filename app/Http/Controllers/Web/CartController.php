<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart(Order $order)
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();


        $userTotalprices = DB::table('carts')->select(DB::raw('SUM(price * quantity) as price'))->where('user_id', $user->id)->groupBy('user_id')->first();


        $totalPrice = 0;
        if (! empty($userTotalprices)) {

            foreach ($userTotalprices as $price) {

                $totalPrice = $price;
            }
        }

        return view('web.cart.show-cart', [
            'carts' => $carts,
            'order' => $order,
            'totalPrice' => $totalPrice
        ]);
    }


    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();
        $discount = ($product->price * $product->discount) / 100;
        $newPrice = $product->price - $discount;


        $cart = Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'img' => $product->img,
            'price' => $newPrice,
        ]);

        return back();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart =  Cart::findOrFail($id);
        $user = Auth::user();

        $cart->where('user_id', $user->id)->where('product_id', $cart->product_id)->update([
            'quantity' => $request->quantity,
        ]);

         $request->session()->flash('updated', 'Quantity Updated Successfly');
        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back();
    }



}
