<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //Checkout
    public function showCheckOut()
    {
        $user = Auth::user();
        return view('web.checkout.checkout', [
             'user' => $user,
        ]);
    }

    public function storeCheckOut(Request $request, Order $order)
    {


        $user = Auth::user();
        $request->validate([
            'user_email' => 'required|email',
            'user_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'user_country' => 'required|string|max:100',
            'user_city' => 'required|string|max:100',
            'user_address' => 'required|string',
        ]);



        $order = Order::create([
            'user_id' => $user->id,
            'username' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
            'user_country' => $user->country,
            'user_city' => $user->city,
            'user_address' => $user->address,
        ]);

        $carts = Cart::where('user_id', $user->id)->get();


        foreach ($carts as  $cart) {

            $order->products()->attach($cart->product_id, [
                'unite_price' => $cart->price,
                'quantity_orderd' => $cart->quantity,
                'total_price' => $cart->price * $cart->quantity,
            ]);

            $prodQty = Product::select("quantity")->where('id', $cart->product_id)->first()->quantity;
            $newQty = $prodQty - $cart->quantity;
            Product::where('id', $cart->product_id)->update(['quantity' => $newQty]);
        }

        Cart::where('user_id', $user->id)->delete();
        $request->session()->flash('checkout', 'Order has been sended successfly');
        return redirect(url("/"));
    }
}
