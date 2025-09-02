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
        $store->load('products');
        return view('customer.stores.show', compact('store'));
    }
}
