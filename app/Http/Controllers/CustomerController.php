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
    public function store(Request $request)
    {
        //

        $this->CustomerValidation($request);
        $data = $this->getCustomerData($request);
        ModelsCustomer::create($data);
        return redirect()->route('customers.index')->with('success', __('customer.succes_creating'));
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
    public function edit($id)
    {
        //
        $customer = ModelsCustomer::where('id', $id)->first()->toArray();
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $this->CustomerValidation($request);
        $updateData = $this->getCustomerData($request);
        $id = $request->id;
        ModelsCustomer::where('id', $id)->update($updateData);

        return redirect()->route('customers.index')->with('success', __('customer.success_updating'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        ModelsCustomer::find($id)->delete();


        return back();
    }

    private function getCustomerData($request)
    {
        return [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_id' => $request->user()->id,
        ];
    }

    private function CustomerValidation($request)
    {
        $CustomerValidation = [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ];
    }
}
