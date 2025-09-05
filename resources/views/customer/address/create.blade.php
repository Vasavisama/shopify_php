<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Address - Shopify Clone</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Add New Address</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.address.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="mobile_number" class="block text-gray-700 font-bold mb-2">Mobile Number</label>
                    <input type="text" id="mobile_number" name="mobile_number" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="flat_no" class="block text-gray-700 font-bold mb-2">Flat, House no., Building, Company, Apartment</label>
                    <input type="text" id="flat_no" name="flat_no" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="street" class="block text-gray-700 font-bold mb-2">Area, Street, Sector, Village</label>
                    <input type="text" id="street" name="street" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="landmark" class="block text-gray-700 font-bold mb-2">Landmark</label>
                    <input type="text" id="landmark" name="landmark" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="pincode" class="block text-gray-700 font-bold mb-2">Pincode</label>
                    <input type="text" id="pincode" name="pincode" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="town" class="block text-gray-700 font-bold mb-2">Town/City</label>
                    <input type="text" id="town" name="town" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="state" class="block text-gray-700 font-bold mb-2">State</label>
                    <input type="text" id="state" name="state" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="country" class="block text-gray-700 font-bold mb-2">Country</label>
                    <input type="text" id="country" name="country" class="w-full px-3 py-2 border rounded-lg" value="India" required>
                </div>
                <div>
                    <label for="address_type" class="block text-gray-700 font-bold mb-2">Address Type</label>
                    <select id="address_type" name="address_type" class="w-full px-3 py-2 border rounded-lg" required>
                        <option value="Home">Home</option>
                        <option value="Work">Work</option>
                    </select>
                </div>
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Address</button>
                <a href="{{ route('dashboard.user') }}" class="ml-4 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
