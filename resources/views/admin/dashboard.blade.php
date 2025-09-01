@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="flex justify-between items-center">
        <h3 class="text-gray-700 text-3xl font-medium">Welcome to the Dashboard</h3>
        <div>
            <a href="{{ route('admin.stores.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">
                Create Store
            </a>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Product
            </a>
        </div>
    </div>

    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.66669 9.33333H23.3334" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23.3334 9.33333V21C23.3334 22.2833 22.2834 23.3333 21.0001 23.3333H7.00002C5.71669 23.3333 4.66669 22.2833 4.66669 21V9.33333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.5 14H17.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $stores->count() }}</h4>
                        <div class="text-gray-500">Stores</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                     <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.33333 23.3333V4.66667M18.6667 23.3333V4.66667M4.66667 23.3333H14M14 4.66667H23.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $productsCount }}</h4>
                        <div class="text-gray-500">Products</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 4.66667L22.1667 9.33333V18.6667L14 23.3333L5.83333 18.6667V9.33333L14 4.66667Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.83333 9.33333L14 14L22.1667 9.33333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14 23.3333V14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $themesCount }}</h4>
                        <div class="text-gray-500">Themes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h4 class="text-gray-700 text-xl font-medium">Recent Stores</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @forelse ($stores->take(3) as $store)
                @php
                    $theme = $store->theme;
                    $bgColor = $theme ? $theme->background_color : '#ffffff';
                    $fontColor = $theme ? $theme->font_color : '#000000';
                    $fontStyle = $theme ? $theme->font_style : 'normal';
                    $fontSize = $theme ? $theme->font_size . 'px' : '16px';
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
                            {{ Str::limit($store->description, 100) ?? 'No description provided.' }}
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.stores.show', $store) }}" class="text-blue-500 hover:text-blue-700 font-bold">View Store</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    <p>No stores found. <a href="{{ route('admin.stores.create') }}" class="text-blue-500 hover:underline">Create one now!</a></p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
