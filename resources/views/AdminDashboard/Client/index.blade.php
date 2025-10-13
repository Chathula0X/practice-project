<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Client Dashboard</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Sidebar section -->
  <aside class="w-64 bg-white shadow-md">
    <x-sidebar />
  </aside>

  <!-- Main content section -->
  <main class="flex-1 p-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Client</h1>
  
    <!-- Wider & shorter card box -->
    <div class="bg-white shadow-md rounded-2xl p-4 w-full max-w-7xl h-24 flex flex-col justify-center">

      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-xl font-semibold text-gray-800 mb-1">Client Management</h2>
          <p class="text-gray-600">You can create and manage your clients here.</p>
        </div>

        <!-- Button -->
        <button
          class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">
          + Create Client
        </button>
      </div>
    </div>
  </main>

</div>

</body>
</html>
