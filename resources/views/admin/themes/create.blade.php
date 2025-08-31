@extends('layouts.admin')

@section('title', 'Create Theme')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Create a New Theme</h3>

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

        <form action="{{ route('admin.themes.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Theme Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" name="name" type="text" placeholder="e.g., Modern Dark" value="{{ old('name') }}" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="background_color">
                        Background Color
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('background_color') border-red-500 @enderror" id="background_color" name="background_color" type="color" value="{{ old('background_color', '#FFFFFF') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="font_color">
                        Font Color
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('font_color') border-red-500 @enderror" id="font_color" name="font_color" type="color" value="{{ old('font_color', '#000000') }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="font_style">
                        Font Style
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('font_style') border-red-500 @enderror" id="font_style" name="font_style">
                        <option value="serif" @if(old('font_style') == 'serif') selected @endif>Serif</option>
                        <option value="sans-serif" @if(old('font_style') == 'sans-serif') selected @endif>Sans-serif</option>
                        <option value="monospace" @if(old('font_style') == 'monospace') selected @endif>Monospace</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="font_size">
                        Font Size
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('font_size') border-red-500 @enderror" id="font_size" name="font_size">
                        <option value="small" @if(old('font_size') == 'small') selected @endif>Small</option>
                        <option value="medium" @if(old('font_size', 'medium') == 'medium') selected @endif>Medium</option>
                        <option value="large" @if(old('font_size') == 'large') selected @endif>Large</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="logo">
                    Logo
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('logo') border-red-500 @enderror" id="logo" name="logo" type="file">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_css">
                    Custom CSS
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('custom_css') border-red-500 @enderror" id="custom_css" name="custom_css" rows="6" placeholder="e.g., .button { background-color: #ff0000; }">{{ old('custom_css') }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Theme
                </button>
                <a href="{{ route('admin.themes.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
