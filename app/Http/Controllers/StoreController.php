<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ApplyThemeToStore;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('theme')->latest()->paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $themes = Theme::all();
        return view('admin.stores.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:stores',
            'theme_id' => 'required|exists:themes,id',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'multi_channel_sales' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }
        $validated['user_id'] = auth()->id();

        $store = Store::create($validated);

        ApplyThemeToStore::dispatch($store);

        return redirect()->route('admin.stores.index')->with('success', 'Store created successfully. The theme is being applied in the background.');
    }

    public function edit(Store $store)
    {
        $themes = Theme::all();
        return view('admin.stores.edit', compact('store', 'themes'));
    }

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:stores,domain,' . $store->id,
            'theme_id' => 'required|exists:themes,id',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'multi_channel_sales' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($store->logo_path) {
                Storage::disk('public')->delete($store->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $store->update($validated);

        ApplyThemeToStore::dispatch($store);

        return redirect()->route('admin.stores.index')->with('success', 'Store updated successfully. The theme is being applied in the background.');
    }

    public function show(Store $store)
    {
        $store->load('products.images');
        return view('admin.stores.show', compact('store'));
    }

    public function destroy(Store $store)
    {
        if ($store->logo_path) {
            Storage::disk('public')->delete($store->logo_path);
        }

        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Store deleted successfully.');
    }
}
