<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $customers  = Customer::get();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email|max:255',
            'address' => 'required|string',

            'mobile_no'  =>  'required|numeric',

            'pincode'  => 'required|numeric',

            'ur_image'  =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            // other validation rules
        ]);
        if ($request->hasFile('ur_image')) {
            $imageName = time() . '.' . $request->ur_image->extension();
            $request->ur_image->move(public_path('customer'), $imageName);
            $request->merge(['image' => $imageName]);
        }


        $customer = Customer::create($request->all());
        return redirect()->back()->route('admin.customers.index')->withSuccess('Customer created successfully!!!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return  view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'mobile_no' => 'required|numeric',
            'pincode' => 'required|numeric',
            'ur_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            // Other validation rules
        ]);

        $customer = Customer::where('id', $id)->first();

        if ($request->hasFile('ur_image')) {
            $imageName = time() . '.' . $request->ur_image->extension();
            $request->ur_image->move(public_path('customer'), $imageName);
            $request->merge(['image' => $imageName]);
            $customer->image = $request->image;
        }

        // Update customer details

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->mobile_no = $request->mobile_no;
        $customer->pincode = $request->pincode;

        $customer->save();

        // return redirect()->back()->withSuccess('Customer updated !!!!!');
        return redirect()->route('admin.customers.index')->withSuccess('Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        // Remove customer image if exists
        if ($customer->image && file_exists(public_path('customer/' . $customer->image))) {
            unlink(public_path('customer/' . $customer->image));
        }

        $customer->delete();

        return redirect()->back()->withSuccess('Customer deleted successfully!');
    }
}
