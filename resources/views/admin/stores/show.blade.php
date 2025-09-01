@extends('layouts.admin')

@section('title', 'Store Details')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">{{ $store->name }}</h3>
        <a href="{{ route('admin.products.create', ['store_id' => $store->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Product
        </a>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Domain</label>
            <p class="text-gray-700">{{ $store->domain }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Theme</label>
            <p class="text-gray-700">{{ $store->theme->name ?? 'No Theme' }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <p class="text-gray-700">{{ $store->description ?? 'N/A' }}</p>
        </div>
    </div>

    <h4 class="text-gray-700 text-2xl font-medium mt-8">Products</h4>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-center">Price</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($store->products as $product)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <span class="font-medium">{{ $product->name }}</span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $product->description }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span>${{ number_format($product->price, 2) }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-6 text-center">No products found for this store.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
