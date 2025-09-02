@extends('layouts.customer')

@section('content')
<div class="container">
    <h1>{{ $store->name }}</h1>
    <p>{{ $store->description }}</p>
    <hr>
    <h2>Products</h2>
    <div class="row">
        @foreach($store->products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        <div class="d-flex">
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                            @auth
                                <form action="{{ route('wishlist.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        &#x2661; Add to Wishlist
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
