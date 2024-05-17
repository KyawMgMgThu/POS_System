<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelsProduct;
use App\Models\ModelsCustomer;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response(
                $request->user()->cart()->get()
            );
        }
        return view('cart.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:models_products,barcode',
        ]);

        $barcode = $request->input('barcode');
        $product = ModelsProduct::where('barcode', $barcode)->first();

        if ($product) {
            $cartItem = $request->user()->cart()->where('product_id', $product->id)->first();
            if ($cartItem) {
                $request->user()->cart()->updateExistingPivot($product->id, ['quantity' => $cartItem->pivot->quantity + 1]);
            } else {
                $request->user()->cart()->attach($product->id, ['quantity' => 1]);
            }
        }

        return response('', 204);
    }
}
