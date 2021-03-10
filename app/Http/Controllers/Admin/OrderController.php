<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(6);

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }




    public function show(Order $order)
    {
        $rows= $order->products()->where('order_id', $order->id)->get();

        $total = DB::table('order_product')
        ->select(DB::raw('SUM(total_price) as total'))
        ->where('order_id', '=', $order->id)
        ->groupBy('order_id')->get();

        return view('admin.orders.show', [
            'rows' => $rows,
            'order' => $order,
            'total' => $total
        ]);

    }

    public function delete(Order $order)
    {
        $order->delete();

        return back();
    }



    public function approved(Order $order)
    {
        $order->update([
            'status' => "approved",
        ]);

        return redirect(url("/dashboard/orders"));
    }

    public function canceled(Order $order)
    {
        $order->update([
            'status' => "canceled",
        ]);

        return redirect(url("/dashboard/orders"));
    }
}
