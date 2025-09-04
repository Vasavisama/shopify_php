<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $stores = Store::whereHas('user', function ($query) {
            $query->where('role', 'admin');
        })->get();
        return view('customer.stores.index', compact('stores'));
    }

    public function show(Store $store)
    {
        $store->load('products', 'theme');
        return view('customer.stores.show', compact('store'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'street' => 'required|string|max:255',
            'landmark' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'flat_no' => 'required|string|max:255',
            'address_type' => 'required|in:Home,Work',
        ]);

        $request->user()->addresses()->create($request->all());

        return redirect()->route('cart.index')->with('success', 'Address saved successfully!');
    }

    public function selectAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        session(['selected_address_id' => $request->address_id]);

        return redirect()->route('cart.index')->with('success', 'Address selected successfully!');
    }
}
