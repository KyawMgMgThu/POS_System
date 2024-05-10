<?php

namespace App\Http\Controllers;

use App\Models\ModelsCart;
use App\Models\ModelsProduct;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $products = ModelsProduct::all();
        $orders = ModelsCart::all();
        return view('cart.index', ['products' => $products, 'orders' => $orders]);
    }
}
