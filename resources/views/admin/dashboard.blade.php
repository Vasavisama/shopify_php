@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="flex justify-between items-center">
        <h3 class="text-gray-700 text-3xl font-medium">Welcome to the Dashboard</h3>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Product
        </a>
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
        <h4 class="text-gray-700 text-xl font-medium">Stores</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($stores as $store)
                <a href="{{ route('admin.stores.show', $store) }}" class="block">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300"
                         style="
                            background-color: {{ $store->theme->background_color ?? '#ffffff' }};
                            color: {{ $store->theme->font_color ?? '#000000' }};
                            font-family: {{ $store->theme->font_style ?? 'sans-serif' }};
                            font-size: {{ $store->theme->font_size ?? 'medium' }};
                         ">
                        <div class="p-6">
                            <h5 class="text-lg font-bold">{{ $store->name }}</h5>
                            <p class="mt-2">{{ $store->domain }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
