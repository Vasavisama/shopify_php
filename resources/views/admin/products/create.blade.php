@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Add a New Product</h3>

    <div class="mt-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="store_id">
                    Store
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="store_id" name="store_id" required>
                    <option value="">Select a store</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Product Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Price
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" name="price" type="number" step="0.01" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                    Inventory Quantity
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" name="quantity" type="number" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="images">
                    Product Images
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="images" name="images[]" type="file" multiple>
            </div>

            <hr class="my-6">

            <h4 class="text-xl font-semibold mb-4">Product Variants</h4>
            <div id="variants-container">
                <!-- Dynamic variants will be added here -->
            </div>
            <button type="button" id="add-variant-btn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Add Variant
            </button>

            <div class="flex items-center justify-between mt-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Add Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-variant-btn').addEventListener('click', function () {
            const container = document.getElementById('variants-container');
            const index = container.children.length;
            const variantHtml = `
                <div class="variant-group border-t pt-4 mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Variant Name (e.g., Size)</label>
                            <input type="text" name="variants[${index}][name]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Variant Value (e.g., Large)</label>
                            <input type="text" name="variants[${index}][value]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price Modifier</label>
                            <input type="number" step="0.01" name="variants[${index}][price_modifier]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>
                    </div>
                     <button type="button" class="remove-variant-btn mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Remove</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', variantHtml);
        });

        document.getElementById('variants-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-variant-btn')) {
                e.target.closest('.variant-group').remove();
            }
        });
    </script>
@endsection
