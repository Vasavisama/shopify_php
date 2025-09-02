@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Stores</h1>
        <a href="{{ route('cart.index') }}" class="btn btn-primary">
            View Cart
        </a>
    </div>

    <div class="list-group">
        @if(isset($stores) && $stores->count() > 0)
            @foreach($stores as $store)
                <a href="{{ route('customer.stores.show', $store) }}" class="list-group-item list-group-item-action">
                    {{ $store->name }}
                </a>
            @endforeach
        @else
            <p>No stores found.</p>
        @endif
    </div>
</div>
@endsection
