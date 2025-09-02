@extends('layouts.customer')

@section('content')
<div class="container">
    <h1>Your Wishlist</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($wishlist->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlist as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>${{ $item->product->price }}</td>
                        <td>
                            <form action="{{ route('wishlist.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                            <form action="{{ route('cart.add', $item->product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your wishlist is empty.</p>
    @endif
</div>
@endsection
