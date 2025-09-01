@extends('layouts.admin')

@section('title', 'Stores')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Stores</h3>
        <a href="{{ route('admin.stores.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create New Store
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($stores as $store)
            @php
                $theme = $store->theme;
                $fontMap = [
                    'small' => '12px',
                    'medium' => '16px',
                    'large' => '20px',
                ];

                if ($theme) {
                    $bgColor = $theme->background_color ?? '#ffffff';
                    $fontColor = $theme->font_color ?? '#000000';
                    $fontStyle = $theme->font_style ?? 'sans-serif';
                    $fontSize = $fontMap[$theme->font_size] ?? '16px';
                } else {
                    $bgColor = '#ffffff';
                    $fontColor = '#000000';
                    $fontStyle = 'sans-serif';
                    $fontSize = '16px';
                }
            @endphp
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: {{ $bgColor }}; color: {{ $fontColor }}; font-family: {{ $fontStyle }}; font-size: {{ $fontSize }};">
                @if($store->logo_path)
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $store->logo_path) }}" alt="{{ $store->name }} logo">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gray-200">
                        <span class="text-gray-500">No Logo</span>
                    </div>
                @endif
                <div class="p-6">
                    <h4 class="font-bold text-xl mb-2">{{ $store->name }}</h4>
                    <p class="text-base mb-4">
                        {{ $store->description ?? 'No description provided.' }}
                    </p>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.stores.show', $store) }}" class="text-blue-500 hover:text-blue-700 font-bold">View Store</a>
                        <div class="flex items-center">
                            <a href="{{ route('admin.stores.edit', $store) }}" class="text-gray-500 hover:text-gray-700 mr-4">Edit</a>
                            <form action="{{ route('admin.stores.destroy', $store) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                <p>No stores found. <a href="{{ route('admin.stores.create') }}" class="text-blue-500 hover:underline">Create one now!</a></p>
            </div>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $stores->links() }}
    </div>
@endsection
