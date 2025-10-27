<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Itineraries - {{ $inquiry->destination }}</title>
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
    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-4">
        <!-- Toggle Sidebar Button -->
        <button onclick="toggleSidebar()" class="p-2 rounded-lg bg-white shadow-md hover:bg-gray-50 transition">
          <svg id="menuIcon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Itineraries</h1>
          <p class="text-gray-600 mt-1">Client: {{ $inquiry->client->name }} | Destination: {{ $inquiry->destination }}</p>
        </div>
      </div>
      <div class="flex gap-3">
        <a href="{{ route('inquiry.index', $inquiry->id) }}" 
           class="px-6 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition font-medium">
          ← Back to Inquiries
        </a>
        <a href="{{ route('itinerary.create', $inquiry->id) }}" 
           class="px-6 py-2 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-medium">
          Create Itinerary
        </a>
      </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
      <p class="text-green-800">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Inquiry Summary Card -->
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-2xl p-6 mb-6">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Inquiry Details</h2>
      <div class="grid grid-cols-4 gap-4">
        <div>
          <p class="text-sm text-gray-600">Dates</p>
          <p class="font-semibold text-gray-800">{{ $inquiry->start_date }} to {{ $inquiry->end_date }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Budget</p>
          <p class="font-semibold text-green-600">${{ number_format($inquiry->budget, 2) }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Client Email</p>
          <p class="font-semibold text-gray-800">{{ $inquiry->client->email }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Total Itineraries</p>
          <p class="font-semibold text-purple-600">{{ $itineraries->count() }}</p>
        </div>
      </div>
    </div>

    <!-- Itineraries List -->
    @if($itineraries->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($itineraries as $itinerary)
        <div class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition">
          <!-- Card Header -->
          <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-4">
            <h3 class="text-xl font-bold text-white">{{ $itinerary->title }}</h3>
            <p class="text-purple-100 text-sm">{{ $itinerary->destination }}</p>
          </div>

          <!-- Card Body -->
          <div class="p-4 space-y-3">
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
              </svg>
              {{ $itinerary->start_date }} - {{ $itinerary->end_date }}
            </div>

            <div class="flex items-center justify-between">
              <span class="text-sm text-gray-600">Duration:</span>
              <span class="font-semibold text-gray-800">{{ Carbon\Carbon::parse($itinerary->start_date)->diffInDays(Carbon\Carbon::parse($itinerary->end_date)) }} days</span>
            </div>

            <div class="flex items-center justify-between">
              <span class="text-sm text-gray-600">Total Cost:</span>
              <span class="font-bold text-green-600 text-xl">${{ number_format($itinerary->astimated_cost, 2) }}</span>
            </div>

            <div class="flex items-center justify-between">
              <span class="text-sm text-gray-600">Status:</span>
              <span class="px-3 py-1 text-xs font-semibold rounded-full
                {{ $itinerary->status === 'approved' ? 'bg-green-100 text-green-800' : 
                   ($itinerary->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                   ($itinerary->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                   'bg-gray-100 text-gray-800')) }}">
                {{ ucfirst($itinerary->status) }}
              </span>
            </div>

            <!-- Budget Breakdown -->
            <div class="border-t pt-3 mt-3">
              <p class="text-xs text-gray-500 mb-2">Budget Breakdown:</p>
              <div class="space-y-1 text-xs">
                <div class="flex justify-between">
                  <span class="text-gray-600">Accommodation:</span>
                  <span class="font-medium">${{ number_format($itinerary->accommodation_total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Transport:</span>
                  <span class="font-medium">${{ number_format($itinerary->transport_total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Activities:</span>
                  <span class="font-medium">${{ number_format($itinerary->activities_total, 2) }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Card Actions -->
          <div class="p-4 bg-gray-50 border-t flex gap-2">
            <a href="{{ route('itinerary.show', $itinerary->id) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-center text-sm font-medium" title="View Itinerary">
              View Itinerary
            </a>
            <a href="{{ route('itinerary.edit', $itinerary->id) }}" class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-center text-sm font-medium" title="Edit Itinerary">
              Edit Itinerary
            </a>
            <form action="{{ route('itinerary.delete', $itinerary->id) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this itinerary?')" class="flex-1">
              @csrf
              @method('DELETE')
              <button type="submit" 
                      class="flex-1 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-center text-sm font-medium" title="Delete Itinerary">
                Delete Itinerary
              </button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="bg-white shadow-md rounded-2xl p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Itineraries Yet</h3>
        <p class="text-gray-500 mb-6">Create your first itinerary for this inquiry to get started.</p>
        <a href="{{ route('itinerary.create', $inquiry->id) }}" class="flex-1 px-3 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 text-center text-sm font-medium" title="Create First Itinerary">
          Create First Itinerary
        </a>
      </div>
    @endif

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
    // Show sidebar
    sidebar.classList.remove('-translate-x-full');
    mainContent.classList.remove('ml-0');
    mainContent.classList.add('ml-64');
    menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
  } else {
    // Hide sidebar
    sidebar.classList.add('-translate-x-full');
    mainContent.classList.remove('ml-64');
    mainContent.classList.add('ml-0');
    menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>';
  }
}
</script>

</body>
</html>

