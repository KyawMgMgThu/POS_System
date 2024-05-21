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
        $cartItem = $request->user()->cart()->where('barcode', $barcode)->first();

        if ($cartItem) {
            if ($product->quantity < 5) {
                return response([
                    'message' => 'Product available: ' . $product->quantity,
                ], 400);
            }
            $cartItem->pivot->quantity += 1;
            $cartItem->pivot->save();
        } else {
            if ($product->quantity < 1) {
                return response([
                    'message' => 'Product is out of stock',
                ], 400);
            }
            $request->user()->cart()->attach($product->id, [
                'quantity' => 1
            ]);
        }

        return response('', 204);
    }

    public function changeQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:models_products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        $cart = $request->user()->cart()->where('id', $request->product_id)->first();
        if ($cart) {

            $cart->pivot->quantity = $request->quantity;
            $cart->pivot->save();
        }
        return response()->json([
            'success' => true
        ]);
    }
    public function destroy(Request $request, $id)
    {

        $cartItem = $request->user()->cart()->where('id', $id)->first();
        if ($cartItem) {
            $cartItem->pivot->delete();
        } else {

            return response()->json(['error' => 'Cart item not found'], 404);
        }

        return response()->json(['message' => 'Cart item deleted successfully'], 200);
    }

    public function empty(Request $request)
    {
        $request->user()->cart()->detach();
        return response('', 204);
    }
}
