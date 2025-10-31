<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <title>Supplier Management</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Fixed Sidebar -->
  <aside id="sidebar" class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto transition-all duration-300 z-40">
    <x-sidebar />
  </aside>

  <!-- Main Content -->
  <main id="mainContent" class="ml-64 flex-1 p-8 bg-gray-50 w-full transition-all duration-300">
    
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <!-- Toggle Sidebar Button -->
        <button onclick="toggleSidebar()" class="p-2 rounded-lg bg-white shadow-md hover:bg-gray-50 transition">
          <svg id="menuIcon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Supplier Management</h1>
          <p class="text-gray-600 mt-1">Manage your suppliers and their information</p>
        </div>
      </div>
    </div>

    <!-- Search and Create Bar -->
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6">
      <div class="flex flex-wrap sm:flex-nowrap items-center justify-between gap-4">
        <!-- Search -->
        <div class="flex items-center gap-3 w-full sm:w-auto sm:flex-1">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          <input 
            type="text" 
            id="searchInput"
            placeholder="Search suppliers by name, type, or location..." 
            class="px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:max-w-md"
            onkeyup="searchTable()"
          />
        </div>

        <!-- Create Supplier Button -->
        <a 
          href="{{ route('supplier.create') }}" 
          class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-semibold shadow-lg flex items-center gap-2 w-full sm:w-auto justify-center flex-shrink-0"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Create Supplier
        </a>
      </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
      <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm" id="suppliersTable">
        <thead class="bg-gray-100 sticky top-0 z-20 shadow-sm">
         <tr>
            <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider w-16 bg-gray-100">ID</th>
            <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider bg-gray-100">Name</th>
            <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider w-32 bg-gray-100">Type</th>
            <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider bg-gray-100">Email</th>
            <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider bg-gray-100">Location</th>
            <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider bg-gray-100">Notes</th>
            <th class="px-4 py-3 text-center font-bold text-gray-700 uppercase tracking-wider w-40 bg-gray-100">Actions</th>
         </tr>
        </thead>

          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($suppliers as $supplier)
            <tr class="hover:bg-blue-50 transition duration-150">
              <td class="px-4 py-3 font-semibold text-gray-900">#{{ $supplier->id }}</td>
              <td class="px-4 py-3">{{ $supplier->name }}</td>
              <td class="px-4 py-3">
                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                  {{ $supplier->type === 'Hotel' ? 'bg-blue-100 text-blue-800' : '' }}
                  {{ $supplier->type === 'Transport' ? 'bg-green-100 text-green-800' : '' }}
                  {{ $supplier->type === 'Tour Company' ? 'bg-purple-100 text-purple-800' : '' }}">
                  {{ $supplier->type }}
                </span>
              </td>
              <td class="px-4 py-3 text-gray-700">{{ $supplier->email }}</td>
              <td class="px-4 py-3 text-gray-700">{{ $supplier->location }}</td>
              <td class="px-4 py-3 truncate max-w-xs text-gray-600" title="{{ $supplier->notes }}">
                {{ $supplier->notes ?? 'N/A' }}
              </td>
              <td class="px-4 py-3 text-center">
                <div class="flex justify-center gap-2">
                  
                  <!-- Edit Button -->
                  <button 
                    onclick="openEditModal({{ $supplier->id }}, '{{ addslashes($supplier->name) }}', '{{ addslashes($supplier->type) }}', '{{ addslashes($supplier->email) }}', '{{ addslashes($supplier->location) }}', '{{ addslashes($supplier->notes ?? '') }}')" 
                    class="p-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                    title="Edit Supplier"
                  >
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                  </button>

                  <!-- Delete Button -->
                  <form 
                    action="{{ route('supplier.delete', $supplier->id) }}" 
                    method="POST" 
                    class="inline" 
                    onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" title="Delete Supplier">
                      <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                  </form>

                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                <div class="flex flex-col items-center justify-center">
                  <i data-lucide="database" class="w-12 h-12 text-gray-300 mb-3"></i>
                  <p class="text-lg font-medium">No suppliers found</p>
                  <p class="text-gray-400 text-sm mt-1">Create your first supplier to get started</p>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </main>
</div>

<!-- Include Edit Modal -->
@include('admin-dashboard.Supplier.edit')

<script>
  // Lucide icon initialization
  lucide.createIcons();

  function openEditModal(id, name, type, email, location, notes) {
    const form = document.getElementById('editForm');
    form.action = `/supplier/${id}`;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_location').value = location;
    document.getElementById('edit_notes').value = notes;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
  }

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

  // Search filter
  function searchTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#suppliersTable tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(input) ? '' : 'none';
    });
  }
</script>
</body>
</html>
