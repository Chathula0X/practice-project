<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard</title>
</head>
<body>
<div class="w-64 bg-gray-800 text-white min-h-screen flex flex-col">
    <!-- Sidebar Header -->
    <div class="p-4 text-xl font-semibold border-b border-gray-700">
        Dashboard
    </div>

    <!-- Navigation -->
    <nav class="mt-4 space-y-1 flex-1">
        <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-700 transition rounded">
            Home
        </a>
        <a href="{{ route('client.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition rounded">
            Clients
        </a>
        <a href="{{ route('supplier.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition rounded">
            Suppliers
        </a>
        <a href="#" class="block px-6 py-3 hover:bg-gray-700 transition rounded">
            Settings
        </a>
    </nav>

    <!-- Logout Button at Bottom -->
    <div class="p-4 mt-auto border-t border-gray-700">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                Logout
            </button>
        </form>
    </div>
</div>
</body>
</html>
