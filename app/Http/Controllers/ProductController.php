<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
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
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        //
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('products');
        }
        $product = ModelsProduct::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'barcode' => $request->barcode,
            'price' => $request->price,
            'status' => $request->status
        ]);
        if (!$product) {
            return redirect()->back()->with('error', 'Failed to create product');
        }
        return redirect()->route('products.index')->with('success', 'Product created successfully');
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
