<div>
    <h5>Select Address</h5>
    @if($addresses->isEmpty())
        <p>You have no saved addresses. Please add one.</p>
    @else
        <ul class="list-group">
            @foreach($addresses as $address)
                <li class="list-group-item">
                    <form action="{{ route('customer.address.select') }}" method="POST" class="d-flex justify-content-between align-items-center">
                        @csrf
                        <input type="hidden" name="address_id" value="{{ $address->id }}">
                        <div>
                            <strong>{{ $address->name }}</strong> ({{ $address->address_type }})<br>
                            {{ $address->flat_no }}, {{ $address->street }}, {{ $address->landmark }}<br>
                            {{ $address->town }}, {{ $address->state }} - {{ $address->pincode }}<br>
                            {{ $address->country }}<br>
                            Phone: {{ $address->mobile_number }}
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Deliver Here</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <hr>
    @endif

    <div class="d-grid">
        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addAddressForm" aria-expanded="false" aria-controls="addAddressForm">
            + Add a new address
        </button>
    </div>

    <div class="collapse mt-3" id="addAddressForm">
        @include('partials.address_form')
    </div>
</div>
