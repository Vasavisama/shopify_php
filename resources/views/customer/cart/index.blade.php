@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Your Cart</h1>
        @auth
            <a href="{{ route('wishlist.index') }}" class="btn btn-outline-primary">
                View Wishlist
            </a>
        @endauth
    </div>
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
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control" style="width: 60px;">
                                <button type="submit" class="btn btn-secondary btn-sm ms-2">Update</button>
                            </form>
                        </td>
                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <h3>Total: ${{ $total }}</h3>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
