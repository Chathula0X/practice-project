<div class="w-64 bg-gray-800 text-white min-h-screen">
    <div class="p-4 text-xl font-semibold border-b border-gray-700">
        Dashboard
    </div>
    <nav class="mt-4 space-y-1">
        <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
            Home
        </a>
        <a href="{{ route('client.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
            Clients
        </a>
        <a href="{{ route('supplier.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
            Suppliers
        </a>
        <a href="#" class="block px-6 py-3 hover:bg-gray-700 transition">
            Settings
        </a>
    </nav>
</div>
