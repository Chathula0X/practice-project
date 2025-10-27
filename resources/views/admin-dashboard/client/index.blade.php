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

  <!-- Sidebar -->
  <aside id="sidebar" class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto transition-all duration-300 z-40">
    <x-sidebar />
  </aside>

  <!-- Main content -->
  <main id="mainContent" class="ml-64 flex-1 p-8 bg-gray-50 w-full transition-all duration-300">

    <!-- Page Header (Fixed) -->
    <div class="sticky top-0 z-30 bg-gray-50 mb-4 p-2">
      <div class="flex items-center gap-4 mb-4">
        <button onclick="toggleSidebar()" class="p-2 rounded-lg bg-white shadow-md hover:bg-gray-50 transition">
          <svg id="menuIcon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Client Management</h1>
          <p class="text-gray-600 mt-1">Manage your clients and their information</p>
        </div>
      </div>
    </div>

    <!-- Table Section with Fixed Header + Search -->
    <div class="bg-white shadow-lg rounded-2xl flex flex-col h-[75vh] overflow-hidden">

      <!-- Sticky Search + Table Header -->
      <div class="sticky top-0 z-20 bg-white border-b border-gray-200">

        <!-- Search + Create -->
        <div class="flex flex-wrap items-center justify-between gap-4 p-4">
          <!-- Search -->
          <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input 
              type="text" 
              id="searchInput"
              placeholder="Search clients by name, email, or phone..." 
              class="px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-96"
              onkeyup="searchTable()"
            />
          </div>

          <!-- Create Button -->
          <a href="{{ route('client.create') }}" 
             class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-semibold shadow-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Client
          </a>
        </div>

        <!-- Table Header -->
        <div class="overflow-x-auto">
          <table class="w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase w-16">ID</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase">Name</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase">Email</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase">Phone</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase w-32">Nationality</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase">Preferences</th>
                <th class="px-4 py-3 text-center font-semibold text-gray-700 uppercase w-48">Actions</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>

      <!-- Scrollable Table Body -->
      <div class="overflow-y-auto flex-1">
        <table class="w-full divide-y divide-gray-200 text-sm" id="clientsTable">
          <tbody class="bg-white divide-y divide-gray-100">
            @forelse($clients as $client)
            <tr class="hover:bg-blue-50 transition duration-150">
              <td class="px-4 py-3 font-semibold text-gray-900">#{{ $client->id }}</td>
              <td class="px-4 py-3 flex items-center gap-2">
                <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xs">
                  {{ strtoupper(substr($client->name, 0, 2)) }}
                </div>
                {{ $client->name }}
              </td>
              <td class="px-4 py-3 text-gray-700">{{ $client->email }}</td>
              <td class="px-4 py-3 text-gray-700">{{ $client->phone }}</td>
              <td class="px-4 py-3">
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                  {{ $client->nationality }}
                </span>
              </td>
              <td class="px-4 py-3 truncate max-w-xs text-gray-600" title="{{ $client->preferences }}">
                {{ $client->preferences ?? 'N/A' }}
              </td>
              <td class="px-4 py-3 text-center">
                <div class="flex justify-center gap-2">
                  <!-- View -->
                  <a href="{{ route('inquiry.index', $client->id) }}" 
                     class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm" title="View">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </a>

                  <!-- Edit -->
                  <a href="{{ route('client.edit', $client->id) }}" 
                     class="p-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-sm" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                  </a>

                  <!-- Delete -->
                  <form action="{{ route('client.delete', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-sm"
                            title="Delete">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center py-12 text-gray-500">No clients found</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>

  </main>
</div>

<script>
  // Sidebar toggle
  let sidebarVisible = true;
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const menuIcon = document.getElementById('menuIcon');
    
    sidebarVisible = !sidebarVisible;
    
    if (sidebarVisible) {
      sidebar.classList.remove('-translate-x-full');
      mainContent.classList.replace('ml-0', 'ml-64');
      menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
    } else {
      sidebar.classList.add('-translate-x-full');
      mainContent.classList.replace('ml-64', 'ml-0');
      menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>';
    }
  }

  // Search
  function searchTable() {
    const filter = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#clientsTable tbody tr');
    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  }
</script>

</body>
</html>
