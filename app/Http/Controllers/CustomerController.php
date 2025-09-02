<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('customer.stores.index', compact('stores'));
    }

    public function show(Store $store)
    {
        $store->load('products');
        return view('customer.stores.show', compact('store'));
    }
}
