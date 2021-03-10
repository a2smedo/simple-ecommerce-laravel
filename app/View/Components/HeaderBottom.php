<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HeaderBottom extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {

        $user = Auth::user();
        if ($user !== null) {
            $carts = Cart::where('user_id',$user->id)->get();

            $userTotalprices = DB::table('carts')->select(DB::raw('SUM(price * quantity) as price'))->where('user_id',$user->id)->groupBy('user_id')->first();

            $totalPrice = 0;
            if (! empty($userTotalprices)) {
                foreach ($userTotalprices as $price) {
                    $totalPrice = $price;
                }
            }

            return view('components.header-bottom', [
                'carts' => $carts,
                'totalPrice' => $totalPrice
            ]);
        }

        return view('components.header-bottom');
    }
}
