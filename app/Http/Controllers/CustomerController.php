<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use Illuminate\Http\Request;
use App\Models\ModelsCustomer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = ModelsCustomer::latest()->paginate(5);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        //
        dd($request);
        $customer = ModelsCustomer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_id' => $request->user()->id
        ]);
        if (!$customer) {
            return redirect()->back()->with('error', 'Failed to create customer');
        }
        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsCustomer $modelsCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsCustomer $modelsCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsCustomer $modelsCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsCustomer $modelsCustomer)
    {
        //
    }
}
