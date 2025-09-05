<div>
    <h5>Select Address</h5>
    @if($addresses->isEmpty())
        <p>No saved addresses.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($addresses as $address)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $address->name }} <span class="badge bg-secondary">{{ $address->address_type }}</span></h5>
                            <p class="card-text">
                                {{ $address->flat_no }}, {{ $address->street }}, {{ $address->landmark }}<br>
                                {{ $address->town }}, {{ $address->state }} - {{ $address->pincode }}<br>
                                {{ $address->country }}<br>
                                Phone: {{ $address->mobile_number }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('customer.address.edit', $address) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('customer.address.destroy', $address) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
    @endif

    <div class="d-grid">
        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addAddressForm" aria-expanded="false" aria-controls="addAddressForm">
            + Add a new address
        </button>
    </div>

    <div class="collapse mt-3" id="addAddressForm">
        <form action="{{ route('customer.address.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="mobile_number" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
            </div>
            <div class="mb-3">
                <label for="flat_no" class="form-label">Flat No</label>
                <input type="text" class="form-control" id="flat_no" name="flat_no" required>
            </div>
            <div class="mb-3">
                <label for="street" class="form-label">Street</label>
                <input type="text" class="form-control" id="street" name="street" required>
            </div>
            <div class="mb-3">
                <label for="landmark" class="form-label">Landmark</label>
                <input type="text" class="form-control" id="landmark" name="landmark" required>
            </div>
            <div class="mb-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" class="form-control" id="pincode" name="pincode" required>
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town</label>
                <input type="text" class="form-control" id="town" name="town" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="mb-3">
                <label for="address_type" class="form-label">Address Type</label>
                <select class="form-select" id="address_type" name="address_type" required>
                    <option value="Home">Home</option>
                    <option value="Work">Work</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Address</button>
        </form>
    </div>
</div>
