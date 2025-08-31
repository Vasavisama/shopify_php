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

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Domain</th>
                    <th class="py-3 px-6 text-center">Theme</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($stores as $store)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('admin.stores.show', $store) }}" class="font-medium text-blue-500 hover:underline">{{ $store->name }}</a>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <a href="http://{{ $store->domain }}" target="_blank" class="text-blue-500 hover:underline">{{ $store->domain }}</a>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span>{{ $store->theme->name ?? 'No Theme' }}</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('admin.stores.edit', $store) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.stores.destroy', $store) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this store?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" style="cursor: pointer; border: none; background: transparent;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center">No stores found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $stores->links() }}
        </div>
    </div>
@endsection
