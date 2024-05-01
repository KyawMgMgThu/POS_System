<?php

namespace App\Http\Controllers;

use App\Models\ModelsProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = ModelsProduct::latest()->paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsProduct $modelsProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsProduct $modelsProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsProduct $modelsProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsProduct $modelsProduct)
    {
        //
    }
}
