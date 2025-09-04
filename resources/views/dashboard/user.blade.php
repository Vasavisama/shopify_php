<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Shopify Clone</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">User Dashboard</h1>
                <p class="text-gray-600">Welcome, {{ auth()->user()->name }}! Your store: <strong>{{ auth()->user()->store->name }}</strong></p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</button>
            </form>
        </div>

        <h2 class="text-2xl font-bold my-8">My Addresses</h2>

        @if ($addresses->isEmpty())
            @include('partials.address_form')
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($addresses as $address)
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h4 class="font-bold text-xl mb-2">{{ $address->name }} <span class="text-sm text-gray-600">({{ $address->address_type }})</span></h4>
                        <p class="text-gray-700">{{ $address->flat_no }}, {{ $address->street }}</p>
                        <p class="text-gray-700">{{ $address->landmark }}</p>
                        <p class="text-gray-700">{{ $address->town }}, {{ $address->state }} - {{ $address->pincode }}</p>
                        <p class="text-gray-700">{{ $address->country }}</p>
                        <p class="text-gray-700">Mobile: {{ $address->mobile_number }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <button id="add-address-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Add a new address
                </button>
            </div>
            <div id="add-address-form" class="hidden mt-8">
                @include('partials.address_form')
            </div>
        @endif

        <h2 class="text-2xl font-bold my-8">Available Stores</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($stores as $store)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                    @if($store->logo_path)
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $store->logo_path) }}" alt="{{ $store->name }} logo">
                    @else
                        <div class="w-full h-48 flex items-center justify-center bg-gray-200">
                            <span class="text-gray-500">No Logo</span>
                        </div>
                    @endif
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="font-bold text-xl mb-2">{{ $store->name }}</h4>
                        <p class="text-gray-700 text-base mb-4 flex-grow">
                            {{ $store->description ? Str::limit($store->description, 100) : 'No description provided.' }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('customer.stores.show', $store) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                View Store
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    <p>No stores found.</p>
                </div>
            @endforelse
        </div>
    </div>
    <script>
        document.getElementById('add-address-btn')?.addEventListener('click', function() {
            document.getElementById('add-address-form').classList.toggle('hidden');
        });
    </script>
</body>
</html>
