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
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md">
    <x-sidebar />
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Admin Dashboard</h1>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <!-- Card 1 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
          <span class="text-blue-500 text-2xl">👥</span>
        </div>
        <p class="text-3xl font-bold mt-4 text-gray-900">1,250</p>
        <p class="text-sm text-green-500 mt-2">↑ 12% from last week</p>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-700">Orders</h2>
          <span class="text-yellow-500 text-2xl">📦</span>
        </div>
        <p class="text-3xl font-bold mt-4 text-gray-900">340</p>
        <p class="text-sm text-green-500 mt-2">↑ 8% this month</p>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-700">Revenue</h2>
          <span class="text-green-500 text-2xl">💰</span>
        </div>
        <p class="text-3xl font-bold mt-4 text-gray-900">$12,400</p>
        <p class="text-sm text-red-500 mt-2">↓ 3% from last month</p>
      </div>

      <!-- Card 4 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-700">Suppliers</h2>
          <span class="text-purple-500 text-2xl">🏭</span>
        </div>
        <p class="text-3xl font-bold mt-4 text-gray-900">48</p>
        <p class="text-sm text-green-500 mt-2">↑ 5 new this week</p>
      </div>
    </div>
  </main>
</div>

</body>
</html>