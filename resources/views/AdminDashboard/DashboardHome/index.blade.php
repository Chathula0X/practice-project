<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Dashboard</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<!-- Toast Notification -->
<x-toast />

<div class="flex min-h-screen">
  <!-- Sidebar - Fixed -->
  <aside class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto">
    <x-sidebar />
  </aside>

  <!-- Main Content - With left margin for fixed sidebar -->
  <main class="flex-1 ml-64 p-8 bg-gray-50">
    <!-- Header Section -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-gray-800">Admin Dashboard</h1>
      <p class="text-gray-600 mt-2">Welcome back! Here's what's happening today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      
      <!-- Card 1 - Clients -->
      <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Clients</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">{{ \App\Models\Client::count() }}</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Card 2 - Users -->
      <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Users</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">{{ \App\Models\User::count() }}</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Card 3 - Inquiries -->
      <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Inquiries</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">{{ \App\Models\Inquiry::count() }}</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Card 4 - Admins -->
      <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Admins</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">{{ \App\Models\Admin::count() }}</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Welcome Message -->
    <div class="bg-white p-8 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Welcome to Admin Dashboard!</h2>
      <p class="text-gray-600">You have successfully logged in as an administrator. Use the sidebar to navigate through different sections.</p>
    </div>
  </main>
</div>

</body>
</html>

