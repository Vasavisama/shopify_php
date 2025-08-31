@extends('layouts.admin')

@section('title', 'Create Store')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Create a New Store</h3>

    <div class="mt-8">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.stores.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Store Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" name="name" type="text" placeholder="e.g., My Awesome Store" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="domain">
                    Domain
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('domain') border-red-500 @enderror" id="domain" name="domain" type="text" placeholder="e.g., my-awesome-store.com" value="{{ old('domain') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="theme_id">
                    Theme
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('theme_id') border-red-500 @enderror" id="theme_id" name="theme_id" required>
                    <option value="">Select a theme</option>
                    @foreach ($themes as $theme)
                        <option value="{{ $theme->id }}" @if(old('theme_id') == $theme->id) selected @endif>{{ $theme->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="logo">
                    Logo
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('logo') border-red-500 @enderror" id="logo" name="logo" type="file">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" id="description" name="description" rows="4" placeholder="A short description of your store.">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="multi_channel_sales" value="1" @if(old('multi_channel_sales')) checked @endif>
                    <span class="ml-2 text-sm text-gray-700">Enable Multi-Channel Sales</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Store
                </button>
                <a href="{{ route('admin.stores.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
