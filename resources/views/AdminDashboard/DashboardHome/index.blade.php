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

<div class="flex min-h-screen">
  <!-- Sidebar - Fixed -->
  <aside class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto">
    <x-sidebar />
  </aside>

  <!-- Main Content - With left margin for fixed sidebar -->
  <main class="flex-1 ml-64 p-8 bg-gray-50">
    <!-- Header Section -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-gray-800">Dashboard Overview</h1>
      <p class="text-gray-600 mt-2">Welcome back! Here's what's happening today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      
      <!-- Card 1 - Clients -->
      <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Clients</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">245</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-sm" style="color: white;">
          <span class="font-semibold">↑ 12%</span>
          <span class="ml-2">vs last month</span>
        </div>
      </div>

      <!-- Card 2 - Suppliers -->
      <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Suppliers</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">82</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-sm" style="color: white;">
          <span class="font-semibold">↑ 8%</span>
          <span class="ml-2">new this week</span>
        </div>
      </div>

      <!-- Card 3 - Revenue -->
      <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Revenue</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">$48.5K</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-sm" style="color: white;">
          <span class="font-semibold">↑ 23%</span>
          <span class="ml-2">from last month</span>
        </div>
      </div>

      <!-- Card 4 - Orders -->
      <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p style="color: white;" class="text-sm font-medium">Total Orders</p>
            <h3 style="color: white;" class="text-3xl font-bold mt-2">1,328</h3>
          </div>
          <div class="bg-white bg-opacity-30 p-3 rounded-full">
            <svg style="color: white;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-sm" style="color: white;">
          <span class="font-semibold">↑ 15%</span>
          <span class="ml-2">this week</span>
        </div>
      </div>
    </div>

    <!-- Charts and Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
      
      <!-- Sales Chart -->
      <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-800">Sales Overview</h2>
          <select class="px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Last 7 days</option>
            <option>Last 30 days</option>
            <option>Last 90 days</option>
          </select>
        </div>
        <canvas id="salesChart" height="80"></canvas>
      </div>

      <!-- Recent Activity -->
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Recent Activity</h2>
        <div class="space-y-4">
          
          <div class="flex items-start space-x-3">
            <div class="bg-blue-100 p-2 rounded-full">
              <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-800">New client added</p>
              <p class="text-xs text-gray-500">John Smith joined</p>
              <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
            </div>
          </div>

          <div class="flex items-start space-x-3">
            <div class="bg-green-100 p-2 rounded-full">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-800">Payment received</p>
              <p class="text-xs text-gray-500">$2,450 from Invoice #3142</p>
              <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
            </div>
          </div>

          <div class="flex items-start space-x-3">
            <div class="bg-purple-100 p-2 rounded-full">
              <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-800">New supplier registered</p>
              <p class="text-xs text-gray-500">ABC Supplies Co.</p>
              <p class="text-xs text-gray-400 mt-1">1 day ago</p>
            </div>
          </div>

          <div class="flex items-start space-x-3">
            <div class="bg-orange-100 p-2 rounded-full">
              <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-800">Order completed</p>
              <p class="text-xs text-gray-500">Order #8923 shipped</p>
              <p class="text-xs text-gray-400 mt-1">2 days ago</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
</div>

<script>
  // Sales Chart
  const ctx = document.getElementById('salesChart').getContext('2d');
  const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Sales',
        data: [12, 19, 15, 25, 22, 30, 28],
        borderColor: 'rgb(59, 130, 246)',
        backgroundColor: 'rgba(59, 130, 246, 0.1)',
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            color: 'rgba(0, 0, 0, 0.05)'
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  });
</script>

</body>
</html>