<?php

namespace App\Http\Controllers;

use App\Events\InventoryUpdated;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('store', 'inventory')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();
        return view('admin.products.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'images.*' => 'nullable|image|max:2048',
            'variants.*.name' => 'nullable|string|max:255',
            'variants.*.value' => 'nullable|string|max:255',
            'variants.*.price_modifier' => 'nullable|numeric',
        ]);

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imagefile) {
                $path = $imagefile->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        if ($request->has('variants')) {
            foreach ($validated['variants'] as $variantData) {
                $product->variants()->create($variantData);
            }
        }

        $product->inventory()->create(['quantity' => $validated['quantity']]);

        event(new InventoryUpdated($product));

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $stores = Store::all();
        $product->load('variants', 'inventory', 'images');
        return view('admin.products.edit', compact('product', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $product->update($validated);

        if ($request->hasFile('images')) {
            // For simplicity, deleting old images and adding new ones.
            $product->images()->delete();
            foreach ($request->file('images') as $imagefile) {
                $path = $imagefile->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        // Simplified variant handling: delete old and create new
        $product->variants()->delete();
        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                $product->variants()->create($variantData);
            }
        }

        $product->inventory()->updateOrCreate([], ['quantity' => $validated['quantity']]);

        event(new InventoryUpdated($product));

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
