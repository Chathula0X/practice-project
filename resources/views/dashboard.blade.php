<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth('admins')->check())
                Admin Dashboard - {{ auth('admins')->user()->name }}
            @else
                User Dashboard - {{ auth()->user()->name }}
            @endif
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4 text-lg font-semibold border-b border-gray-700">
                Dashboard Menu
            </div>
            <nav class="mt-4 space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="block px-6 py-3 hover:bg-gray-700 transition">
                    Home
                </a>
                    <a href="{{ route('client.index') }}" 
                   class="block px-6 py-3 hover:bg-gray-700 transition">
                    Clients
                </a>
                <a href="{{ route('supplier.index') }}" 
                   class="block px-6 py-3 hover:bg-gray-700 transition">
                    Suppliers
                </a>
                <a href="#" 
                   class="block px-6 py-3 hover:bg-gray-700 transition">
                    Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">
                    Dashboard Overview
                </h3>
                <p class="text-gray-600">
                    Welcome to your dashboard. You can navigate using the sidebar on the left.
                </p>
            </div>
        </main>
    </div>
</x-app-layout>
