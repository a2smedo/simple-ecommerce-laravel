<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlists =  Wishlist::where('user_id', $user->id)->orderBy('id')->get();
        return view('web.wishlist.wishlist', ['wishlists' => $wishlists]);

    }

    public function store(Product $product, Wishlist $wishlist, Request $request)
    {
        $user = Auth::user();
        $lists = Wishlist::select('*')->where('user_id', $user->id)->where('product_id', $product->id)->get();

        $wLists = $lists->toArray();

        if (empty($wLists)) {

            $wishlist->create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
        } else {
            foreach ($wLists as $list) {

                if ($list['product_id'] !== $product->id) {
                    $wishlist->create([
                        'user_id' => $user->id,
                        'product_id' => $product->id
                    ]);
                } else {
                    DB::table('wishlists')->where('user_id', '=', $user->id)->where('product_id', '=', $product->id)->update([
                        'user_id' => $user->id,
                        'product_id' => $product->id
                    ]);
                }
            }
        }

        $request->session()->flash('add-wish', "This product Added in Wishlist Successfly");

        return back();
    }


    public function delete(Wishlist $wishlist)
    {
        $wishlist->delete();
        return back();
    }
}
