@extends('layouts.customer')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if(!empty($cart))
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>${{ $details['price'] }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                    <button type="submit" class="btn btn-secondary btn-sm" @if($details['quantity'] <= 1) disabled @endif>-</button>
                                </form>
                                <span class="mx-2">{{ $details['quantity'] }}</span>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                    <button type="submit" class="btn btn-secondary btn-sm">+</button>
                                </form>
                            </div>
                        </td>
                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row mt-4">
            <div class="col-md-6">
                @if($selectedAddress)
                    <h5>Shipping Address:</h5>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $selectedAddress->name }} ({{ $selectedAddress->address_type }})</h5>
                            <p class="card-text">
                                {{ $selectedAddress->flat_no }}, {{ $selectedAddress->street }}, {{ $selectedAddress->landmark }}<br>
                                {{ $selectedAddress->town }}, {{ $selectedAddress->state }} - {{ $selectedAddress->pincode }}<br>
                                {{ $selectedAddress->country }}<br>
                                Phone: {{ $selectedAddress->mobile_number }}
                            </p>
                            <a href="{{ route('customer.addresses.index') }}" class="btn btn-secondary">Change</a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <p>No address selected. Please add or select an address.</p>
                            <a href="{{ route('customer.addresses.index') }}" class="btn btn-primary">Add/Select Address</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6 text-end">
                <h3 class="fw-bold">Total Bill: ${{ number_format($total, 2) }}</h3>
                <button type="button" class="btn btn-primary" @if(!$selectedAddress) disabled @endif>
                    Proceed to Checkout
                </button>
            </div>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
