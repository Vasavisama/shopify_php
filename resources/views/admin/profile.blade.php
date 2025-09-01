@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Admin Profile</h3>

    <div class="mt-8 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <p class="text-gray-700">{{ $admin->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <p class="text-gray-700">{{ $admin->email }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <p class="text-gray-700">{{ ucfirst($admin->role) }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Member Since</label>
            <p class="text-gray-700">{{ $admin->created_at->format('F j, Y') }}</p>
        </div>
    </div>
@endsection
