<?php

namespace App\Http\Controllers;

use App\Models\ModelsOrder;
use Illuminate\Http\Request;
use App\Models\ModelsOrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = new ModelsOrder;
        if ($request->start_date) {
            $orders = $orders->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $orders = $orders->whereDate('created_at', '<=', $request->start_date);
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(5);
        $total = $orders->map(function ($i) {
            return $i->total();
        })->sum();
        $revievedAmount = $orders->map(function ($i) {
            return $i->receivedAmount();
        })->sum();
        return view('orders.index', compact('orders', 'total', 'revievedAmount'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'nullable|integer|exists:models_customers,id',
            'amount' => 'required|numeric|min:0',
            'balance' => 'required|numeric|min:0',

        ]);

        $order = ModelsOrder::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart;

        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);

            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }


        $request->user()->cart()->detach();

        $order->payments()->create([
            'amount' => $request->amount,
            'balance' => $request->balance,
            'user_id' => $request->user()->id,
        ]);

        return 'success';
    }

    public function fetchChartData($timeframe)
    {
        switch ($timeframe) {
            case 'day':
                $priceData = ModelsOrderItem::select(
                    DB::raw('SUM(price) as total_price'),
                    DB::raw('DATE(created_at) as day')
                )
                    ->groupBy('day')
                    ->get();

                $orderCountData = ModelsOrderItem::select(
                    DB::raw('COUNT(DISTINCT models_order_id) as order_count'),
                    DB::raw('DATE(created_at) as day')
                )
                    ->groupBy('day')
                    ->get();
                break;

            case 'month':
                $priceData = ModelsOrderItem::select(
                    DB::raw('SUM(price) as total_price'),
                    DB::raw('MONTH(created_at) as month')
                )
                    ->groupBy('month')
                    ->get();

                $orderCountData = ModelsOrderItem::select(
                    DB::raw('COUNT(DISTINCT models_order_id) as order_count'),
                    DB::raw('MONTH(created_at) as month')
                )
                    ->groupBy('month')
                    ->get();
                break;

            case 'year':
                $priceData = ModelsOrderItem::select(
                    DB::raw('SUM(price) as total_price'),
                    DB::raw('YEAR(created_at) as year')
                )
                    ->groupBy('year')
                    ->get();

                $orderCountData = ModelsOrderItem::select(
                    DB::raw('COUNT(DISTINCT models_order_id) as order_count'),
                    DB::raw('YEAR(created_at) as year')
                )
                    ->groupBy('year')
                    ->get();
                break;

            default:
                return response()->json(['error' => 'Invalid timeframe'], 400);
        }

        return response()->json([
            'priceData' => $priceData,
            'orderCountData' => $orderCountData,
        ]);
    }
}
