<?php

namespace App\Http\Controllers;

use App\Models\ModelsOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = ModelsOrder::latest()->paginate(5);
        return view('orders.indes', compact('orders'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'nullable|integer|exists:models_customers,id',
            'amount' => 'required|numeric|min:0',
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
            'user_id' => $request->user()->id,
        ]);

        return 'success';
    }
}
