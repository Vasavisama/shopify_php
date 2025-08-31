@extends('layouts.admin')

@php
use Illuminate\Support\Str;
@endphp

@section('title', 'Store Details: ' . $store->name)

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-gray-700 text-3xl font-medium">{{ $store->name }}</h3>
            <p class="text-gray-500">{{ $store->domain }}</p>
        </div>
        <a href="{{ route('admin.products.create', ['store_id' => $store->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Product to this Store
        </a>
    </div>

    <h4 class="text-gray-600 text-xl font-medium mb-4">Products</h4>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($store->products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($product->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
                <div class="p-4">
                    <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                    <p class="text-gray-600 mt-1">${{ number_format($product->price, 2) }}</p>
                    <p class="text-gray-500 text-sm mt-2">{{ Str::limit($product->description, 100) }}</p>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-sm text-blue-500 hover:underline">Edit</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                <p>No products found in this store yet.</p>
            </div>
        @endforelse
    </div>
@endsection
