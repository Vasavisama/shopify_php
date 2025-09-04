<form action="{{ route('customer.address.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
            <input type="text" id="mobile_number" name="mobile_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="flat_no" class="block text-sm font-medium text-gray-700">Flat No</label>
            <input type="text" id="flat_no" name="flat_no" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
            <input type="text" id="street" name="street" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="landmark" class="block text-sm font-medium text-gray-700">Landmark</label>
            <input type="text" id="landmark" name="landmark" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
            <input type="text" id="pincode" name="pincode" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="town" class="block text-sm font-medium text-gray-700">Town</label>
            <input type="text" id="town" name="town" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="state" class="block text-sm font-medium text-gray-700">State</label>
            <input type="text" id="state" name="state" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
            <input type="text" id="country" name="country" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="address_type" class="block text-sm font-medium text-gray-700">Address Type</label>
            <select id="address_type" name="address_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="Home">Home</option>
                <option value="Work">Work</option>
            </select>
        </div>
    </div>
    <div class="mt-6 text-right">
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Save Address
        </button>
    </div>
</form>
