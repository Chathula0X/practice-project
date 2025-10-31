<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Client Inquiries</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">

  <!-- Fixed Sidebar -->
  <aside id="sidebar" class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto transition-all duration-300 z-40">
    <x-sidebar />
  </aside>

  <!-- Main content -->
  <main id="mainContent" class="ml-64 flex-1 p-8 bg-gray-50 w-full transition-all duration-300">
    <!-- Header with Toggle Button -->
    <div class="mb-6 flex items-center gap-4">
      <!-- Toggle Sidebar Button -->
      <button onclick="toggleSidebar()" class="p-2 rounded-lg bg-white shadow-md hover:bg-gray-50 transition">
        <svg id="menuIcon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
      <div>
        <h1 class="text-3xl font-bold text-gray-800">
        Travel Requests from {{ $client->name }}
        </h1>
      </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
      <p class="text-green-800">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Search and Action Bar Card -->
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6">
      <div class="flex items-center justify-between gap-4">
        <!-- Search Bar -->
        <div class="flex items-center gap-3 flex-1">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          <input 
            type="text" 
            id="searchInput"
            placeholder="Search inquiries by destination, dates, or notes..." 
            class="px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full max-w-md"
            onkeyup="searchTable()"
          />
        </div>

        <!-- New Inquiry Button -->
        <a href="{{ route('inquiry.create', $client->id) }}" 
           class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-semibold shadow-lg flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          New Request
        </a>
      </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white shadow-md rounded-2xl overflow-x-auto max-h-[500px] overflow-y-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 sticky top-0 z-20 shadow-sm">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($client->inquiries as $inquiry)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->destination }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->start_date }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->end_date }}</td>
            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($inquiry->budget, 2) }}</td>
            <td class="px-6 py-4 max-w-xs truncate" title="{{ $inquiry->note }}">{{ $inquiry->note ?? 'N/A' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex gap-2">
                <!-- Itinerary Icon -->
                <a href="{{ route('itinerary.index', $inquiry->id) }}" 
                   class="flex items-center justify-center w-8 h-8 bg-purple-500 text-white rounded hover:bg-purple-600">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19a7 7 0 100-14 7 7 0 000 14z"></path>
                  </svg>
                </a>

                <!-- Edit Icon -->
                <a href="{{ route('inquiry.edit', $inquiry->id) }}" 
                   class="flex items-center justify-center w-8 h-8 bg-green-500 text-white rounded hover:bg-green-600"
                   title="Edit">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.414 6.414a2 2 0 10-2.828-2.828L11 8.172V12h3.828l3.586-3.586z"></path>
                  </svg>
                </a>

                <!-- Delete Icon -->
                <form action="{{ route('inquiry.delete', $inquiry->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="flex items-center justify-center w-8 h-8 bg-red-500 text-white rounded hover:bg-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M10 4h4m-4 0V2m4 2V2"></path>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @if($client->inquiries->isEmpty())
      <div class="text-center text-gray-500 py-8">No inquiries found for this client.</div>
      @endif
    </div>

  </main>
</div>

<script>
// Toggle Sidebar Function
let sidebarVisible = true;
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  const menuIcon = document.getElementById('menuIcon');
  
  sidebarVisible = !sidebarVisible;
  
  if (sidebarVisible) {
    sidebar.classList.remove('-translate-x-full');
    mainContent.classList.remove('ml-0');
    mainContent.classList.add('ml-64');
    menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
  } else {
    sidebar.classList.add('-translate-x-full');
    mainContent.classList.remove('ml-64');
    mainContent.classList.add('ml-0');
    menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>';
  }
}

// Search functionality
function searchTable() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const table = document.querySelector('table');
  const rows = table.getElementsByTagName('tr');

  for (let i = 1; i < rows.length; i++) {
    const row = rows[i];
    const cells = row.getElementsByTagName('td');
    let found = false;

    for (let j = 0; j < cells.length - 1; j++) {
      const cell = cells[j];
      if (cell) {
        const textValue = cell.textContent || cell.innerText;
        if (textValue.toLowerCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }

    row.style.display = found ? '' : 'none';
  }
}
</script>

</body>
</html>
