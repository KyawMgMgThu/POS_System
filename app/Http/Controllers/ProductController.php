<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelsProduct;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Database\Events\ModelsPruned;

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

        $image_path = '';
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('products', $fileName, 'public');
            $requestData['image'] = '/storage/' . $image_path;
        }
        $product = ModelsProduct::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path,
            'barcode' => $request->barcode,
            'price' => $request->price,
            'quantity' => $request->quantity,
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
    public function edit($id)
    {
        //
        $product = ModelsProduct::where('id', $id)->first()->toArray();
        // Delete old image
        if ($product['image']) {
            Storage::delete($product['image']);
        }
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $this->postValidationCheck($request);
        $updateData = $this->getProductData($request);
        $id = $request->id;
        ModelsProduct::where('id', $id)->update($updateData);
        return redirect()->route('products.index')->with('success', __('products.success_updating'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = ModelsProduct::find($id);
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        return back();
    }

    private function getProductData($request)
    {
        $image_path = '';
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('products', $fileName, 'public');
            $requestData['image'] = '/storage/' . $image_path;
        }




        return [
            'name' => $request->name,
            'description' => $request->postDescription,
            'image' => $image_path,
            'barcode' => $request->barcode,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status
        ];
    }
    private function postValidationCheck($request)
    {

        $validationRule = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'barcode' => 'required|string|max:50|unique:products,barcode' . $request->id,
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required|boolean',
            'quantity' => 'required|integer',
        ];
    }
}
