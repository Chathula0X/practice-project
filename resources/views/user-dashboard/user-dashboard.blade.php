<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Traveler Dashboard</title>
</head>
<body class="bg-gradient-to-br from-sky-100 to-blue-200 min-h-screen font-sans flex">

  <!-- Sidebar -->
  <aside class="w-72 bg-gradient-to-b from-sky-600 to-blue-700 text-white flex flex-col shadow-lg">
    <!-- Logo -->
    <div class="p-6 border-b border-sky-500">
      <h1 class="text-3xl font-extrabold tracking-wide">🌍 TravelEase</h1>
      <p class="text-sm text-sky-200 mt-1">Your Journey Starts Here</p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-5 space-y-3 text-sky-100">
      <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-sky-500 transition">
        🏠 <span>Dashboard</span>
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-sky-500 transition">
        ✈️ <span>My Trips</span>
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-sky-500 transition">
        📅 <span>Bookings</span>
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-sky-500 transition">
        💬 <span>Messages</span>
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-sky-500 transition">
        ⚙️ <span>Settings</span>
      </a>
    </nav>

    <!-- Logout Button -->
    <form action="/logout" method="POST" class="p-5 border-t border-sky-500">
      @csrf
      <button
        type="submit"
        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-lg transition duration-200"
      >
        Logout
      </button>
    </form>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
      <div>
        <h2 class="text-3xl font-bold text-gray-800">Welcome back, <span class="text-sky-600">John!</span></h2>
        <p class="text-gray-500">Plan your next adventure with ease 🌴</p>
      </div>
      <img
        src="https://i.pravatar.cc/60"
        alt="User Avatar"
        class="rounded-full border-4 border-sky-400"
      />
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-gray-700 font-semibold">Upcoming Trips</h3>
          <span class="text-2xl">🧳</span>
        </div>
        <p class="text-4xl font-bold text-sky-600">3</p>
        <p class="text-sm text-gray-500 mt-2">Next: Bali, Indonesia</p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-gray-700 font-semibold">Total Miles</h3>
          <span class="text-2xl">✈️</span>
        </div>
        <p class="text-4xl font-bold text-emerald-500">25,400</p>
        <p class="text-sm text-gray-500 mt-2">Across 7 countries</p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-gray-700 font-semibold">Rewards Points</h3>
          <span class="text-2xl">🎁</span>
        </div>
        <p class="text-4xl font-bold text-amber-500">8,120</p>
        <p class="text-sm text-gray-500 mt-2">Redeem for discounts</p>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Activity</h3>
      <ul class="divide-y divide-gray-200">
        <li class="py-4 flex justify-between">
          <span class="text-gray-700">Booked a trip to Maldives 🏖️</span>
          <span class="text-sm text-gray-500">2 hours ago</span>
        </li>
        <li class="py-4 flex justify-between">
          <span class="text-gray-700">Updated passport information 🛂</span>
          <span class="text-sm text-gray-500">Yesterday</span>
        </li>
        <li class="py-4 flex justify-between">
          <span class="text-gray-700">Earned 300 reward points 💎</span>
          <span class="text-sm text-gray-500">3 days ago</span>
        </li>
      </ul>
    </div>
  </main>

</body>
</html>
