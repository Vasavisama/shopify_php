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
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="quantity" value="{{ $details['quantity'] }}" class="quantity-input">
                                <button type="button" class="btn btn-outline-secondary btn-sm quantity-minus">-</button>
                                <span class="mx-2 quantity">{{ $details['quantity'] }}</span>
                                <button type="button" class="btn btn-outline-secondary btn-sm quantity-plus">+</button>
                                <button type="submit" class="btn btn-primary btn-sm ms-2 update-cart" style="display: none;">Update</button>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.quantity-plus').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const quantitySpan = form.querySelector('.quantity');
            const quantityInput = form.querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;
            quantitySpan.textContent = quantity;
            form.querySelector('.update-cart').style.display = 'inline-block';
        });
    });

    document.querySelectorAll('.quantity-minus').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const quantitySpan = form.querySelector('.quantity');
            const quantityInput = form.querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                quantitySpan.textContent = quantity;
                form.querySelector('.update-cart').style.display = 'inline-block';
            }
        });
    });
});
</script>
@endsection
