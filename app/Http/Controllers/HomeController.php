<?php

namespace App\Http\Controllers;

use App\Models\ModelsOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $orders = ModelsOrder::all();
        $total = $orders->map(function ($i) {
            return $i->total();
        })->sum();
        $revievedAmount = $orders->map(function ($i) {
            return $i->receivedAmount();
        })->sum();
        $totalSellProduct = $orders->map(function ($i) {
            return $i->totalSoldItem();
        })->sum();
        return view('home', compact('total', 'revievedAmount', 'totalSellProduct', 'orders'));
    }
}
