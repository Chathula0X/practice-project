<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
    <body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-white shadow-md">
            <x-sidebar />
        </aside>

        <main class="flex-1 p-8">
             <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
             <p class="text-gray-700">This is the client content area displayed next to the sidebar.</p>
        </main>
    </div>
</body>
</html>