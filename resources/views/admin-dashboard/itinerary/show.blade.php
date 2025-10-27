<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>{{ $itinerary->title }}</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Fixed Sidebar -->
  <aside id="sidebar" class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto transition-all duration-300 z-40">
    <x-sidebar />
  </aside>

  <!-- Main content -->
  <main id="mainContent" class="ml-64 flex-1 p-8 bg-gray-50 w-full transition-all duration-300">
    <div class="max-w-6xl mx-auto">
      
      <!-- Header with Toggle Button and Actions -->
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
          <!-- Toggle Sidebar Button -->
          <button onclick="toggleSidebar()" class="p-2 rounded-lg bg-white shadow-md hover:bg-gray-50 transition">
            <svg id="menuIcon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
          <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $itinerary->title }}</h1>
            <p class="text-gray-600 mt-1">{{ $itinerary->destination }} | {{ $itinerary->start_date->format('M d') }} - {{ $itinerary->end_date->format('M d, Y') }}</p>
          </div>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('itinerary.edit', $itinerary->id) }}" 
             class="px-6 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium">
            Edit
          </a>
          <a href="{{ route('itinerary.index', $itinerary->inquiry_id) }}" 
             class="px-6 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition font-medium">
            ← Back
          </a>
        </div>
      </div>

      <!-- Success Message -->
      @if(session('success'))
      <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <p class="text-green-800">{{ session('success') }}</p>
      </div>
      @endif

      <!-- Overview Cards -->
      <div class="grid grid-cols-4 gap-6 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg text-white">
          <p class="text-blue-100 text-sm">Duration</p>
          <p class="text-3xl font-bold mt-2">{{ $itinerary->getDurationInDays() }}</p>
          <p class="text-blue-100 text-sm">days</p>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-2xl shadow-lg text-white">
          <p class="text-green-100 text-sm">Total Cost</p>
          <p class="text-3xl font-bold mt-2">${{ number_format($itinerary->total_cost, 0) }}</p>
          <p class="text-green-100 text-sm">USD</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-2xl shadow-lg text-white">
          <p class="text-purple-100 text-sm">Client</p>
          <p class="text-xl font-bold mt-2">{{ $itinerary->inquiry->client->name }}</p>
          <p class="text-purple-100 text-sm">{{ $itinerary->inquiry->client->email }}</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-2xl shadow-lg text-white">
          <p class="text-orange-100 text-sm">Status</p>
          <p class="text-2xl font-bold mt-2">{{ ucfirst($itinerary->status) }}</p>
          <form action="{{ route('itinerary.update-status', $itinerary->id) }}" method="POST" class="mt-2">
            @csrf
            @method('PATCH')
            <select name="status" onchange="this.form.submit()" 
                    class="w-full text-sm px-2 py-1 rounded bg-orange-400 text-white border-none">
              <option value="draft" {{ $itinerary->status == 'draft' ? 'selected' : '' }}>Draft</option>
              <option value="pending" {{ $itinerary->status == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="approved" {{ $itinerary->status == 'approved' ? 'selected' : '' }}>Approved</option>
              <option value="rejected" {{ $itinerary->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
          </form>
        </div>
      </div>

      <!-- Budget Breakdown -->
      <div class="bg-white shadow-md rounded-2xl p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
          <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
          </svg>
          Budget Breakdown
        </h2>

        <div class="grid grid-cols-3 gap-4">
          <div class="bg-purple-50 p-4 rounded-lg border-l-4 border-purple-500">
            <p class="text-sm text-gray-600">Accommodation</p>
            <p class="text-2xl font-bold text-purple-600">${{ number_format($itinerary->accommodation_total, 2) }}</p>
            <div class="text-xs text-gray-500 mt-2">
              {{ number_format(($itinerary->total_cost > 0) ? ($itinerary->accommodation_total / $itinerary->total_cost) * 100 : 0, 1) }}% of total
            </div>
          </div>

          <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500">
            <p class="text-sm text-gray-600">Transport</p>
            <p class="text-2xl font-bold text-yellow-600">${{ number_format($itinerary->transport_total, 2) }}</p>
            <div class="text-xs text-gray-500 mt-2">
              {{ number_format(($itinerary->total_cost > 0) ? ($itinerary->transport_total / $itinerary->total_cost) * 100 : 0, 1) }}% of total
            </div>
          </div>

          <div class="bg-pink-50 p-4 rounded-lg border-l-4 border-pink-500">
            <p class="text-sm text-gray-600">Activities</p>
            <p class="text-2xl font-bold text-pink-600">${{ number_format($itinerary->activities_total, 2) }}</p>
            <div class="text-xs text-gray-500 mt-2">
              {{ number_format(($itinerary->total_cost > 0) ? ($itinerary->activities_total / $itinerary->total_cost) * 100 : 0, 1) }}% of total
            </div>
          </div>
        </div>
      </div>

      <!-- Detailed Information Sections -->
      <div class="grid grid-cols-2 gap-6 mb-6">
        
        <!-- Accommodation Details -->
        @if($itinerary->accommodation && !empty(array_filter($itinerary->accommodation)))
        <div class="bg-white shadow-md rounded-2xl p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Accommodation
          </h3>
          <div class="space-y-3">
            @if(isset($itinerary->accommodation['hotel_name']))
            <div>
              <p class="text-sm text-gray-600">Hotel</p>
              <p class="font-semibold text-gray-800">{{ $itinerary->accommodation['hotel_name'] }}</p>
            </div>
            @endif
            @if(isset($itinerary->accommodation['room_type']))
            <div>
              <p class="text-sm text-gray-600">Room Type</p>
              <p class="font-semibold text-gray-800">{{ ucfirst($itinerary->accommodation['room_type']) }}</p>
            </div>
            @endif
            @if(isset($itinerary->accommodation['nights']))
            <div>
              <p class="text-sm text-gray-600">Nights</p>
              <p class="font-semibold text-gray-800">{{ $itinerary->accommodation['nights'] }} nights</p>
            </div>
            @endif
            @if(isset($itinerary->accommodation['cost_per_night']))
            <div>
              <p class="text-sm text-gray-600">Cost per Night</p>
              <p class="font-semibold text-gray-800">${{ number_format($itinerary->accommodation['cost_per_night'], 2) }}</p>
            </div>
            @endif
          </div>
        </div>
        @endif

        <!-- Transport Details -->
        @if($itinerary->transport && !empty(array_filter($itinerary->transport)))
        <div class="bg-white shadow-md rounded-2xl p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
              <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
            </svg>
            Transport
          </h3>
          <div class="space-y-3">
            @if(isset($itinerary->transport['type']))
            <div>
              <p class="text-sm text-gray-600">Type</p>
              <p class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $itinerary->transport['type'])) }}</p>
            </div>
            @endif
            @if(isset($itinerary->transport['from']))
            <div>
              <p class="text-sm text-gray-600">From</p>
              <p class="font-semibold text-gray-800">{{ $itinerary->transport['from'] }}</p>
            </div>
            @endif
            @if(isset($itinerary->transport['to']))
            <div>
              <p class="text-sm text-gray-600">To</p>
              <p class="font-semibold text-gray-800">{{ $itinerary->transport['to'] }}</p>
            </div>
            @endif
            @if(isset($itinerary->transport['cost']))
            <div>
              <p class="text-sm text-gray-600">Cost</p>
              <p class="font-semibold text-gray-800">${{ number_format($itinerary->transport['cost'], 2) }}</p>
            </div>
            @endif
          </div>
        </div>
        @endif
      </div>

      <!-- Activities Timeline -->
      @if($itinerary->activities && count($itinerary->activities) > 0)
      <div class="bg-white shadow-md rounded-2xl p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
          <svg class="w-5 h-5 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
          </svg>
          Activities & Events
        </h3>
        
        <div class="space-y-4">
          @foreach($itinerary->activities as $index => $activity)
            @if(!empty($activity['name']) || !empty($activity['cost']))
            <div class="flex items-start">
              <div class="flex-shrink-0 w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center font-bold">
                {{ $index + 1 }}
              </div>
              <div class="ml-4 flex-1 bg-pink-50 p-4 rounded-lg">
                <div class="flex justify-between items-start">
                  <div>
                    <h4 class="font-semibold text-gray-800">{{ $activity['name'] ?? 'Activity' }}</h4>
                  </div>
                  <div class="text-right">
                    <p class="text-lg font-bold text-pink-600">${{ number_format($activity['cost'] ?? 0, 2) }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        </div>
      </div>
      @endif

      <!-- Timeline View (Day by Day) -->
      <div class="bg-white shadow-md rounded-2xl p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
          <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
          </svg>
          Day-by-Day Timeline
        </h3>

        <div class="relative border-l-4 border-blue-500 pl-6 space-y-6">
          @php
            $currentDate = $itinerary->start_date->copy();
            $dayNumber = 1;
          @endphp
          
          @while($currentDate->lte($itinerary->end_date))
            <div class="relative">
              <div class="absolute -left-9 w-6 h-6 bg-blue-500 rounded-full border-4 border-white"></div>
              <div class="bg-blue-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                  <h4 class="font-bold text-gray-800">Day {{ $dayNumber }}</h4>
                  <span class="text-sm text-gray-600">{{ $currentDate->format('l, M d, Y') }}</span>
                </div>
                
                <div class="space-y-2 text-sm text-gray-700">
                  @if($dayNumber == 1)
                    <p>✈️ Arrival in {{ $itinerary->destination }}</p>
                    @if($itinerary->accommodation && isset($itinerary->accommodation['hotel_name']))
                    <p>🏨 Check-in at {{ $itinerary->accommodation['hotel_name'] }}</p>
                    @endif
                  @elseif($currentDate->eq($itinerary->end_date))
                    <p>🏨 Check-out</p>
                    <p>✈️ Departure from {{ $itinerary->destination }}</p>
                  @else
                    <p>📍 Explore {{ $itinerary->destination }}</p>
                    @if($itinerary->activities && isset($itinerary->activities[$dayNumber - 2]))
                      <p>🎯 {{ $itinerary->activities[$dayNumber - 2]['name'] ?? 'Planned activities' }}</p>
                    @endif
                  @endif
                </div>
              </div>
            </div>
            
            @php
              $currentDate->addDay();
              $dayNumber++;
            @endphp
          @endwhile
        </div>
      </div>

      <!-- Additional Notes -->
      @if($itinerary->notes)
      <div class="bg-yellow-50 border-l-4 border-yellow-500 shadow-md rounded-2xl p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Additional Notes</h3>
        <p class="text-gray-700 whitespace-pre-line">{{ $itinerary->notes }}</p>
      </div>
      @endif

      <!-- Action Buttons -->
      <div class="flex gap-4">
        <button onclick="window.print()" 
                class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-xl hover:bg-blue-700 transition font-semibold">
          🖨️ Print Itinerary
        </button>
        <a href="{{ route('itinerary.edit', $itinerary->id) }}" 
           class="flex-1 bg-green-600 text-white py-3 px-6 rounded-xl hover:bg-green-700 transition font-semibold text-center">
          ✏️ Edit Itinerary
        </a>
        <form action="{{ route('itinerary.delete', $itinerary->id) }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete this itinerary? This action cannot be undone.')" 
              class="flex-1">
          @csrf
          @method('DELETE')
          <button type="submit" 
                  class="w-full bg-red-600 text-white py-3 px-6 rounded-xl hover:bg-red-700 transition font-semibold">
            🗑️ Delete Itinerary
          </button>
        </form>
      </div>

    </div>
  </main>
</div>

<style>
@media print {
  aside, button, form[method="POST"], .no-print {
    display: none !important;
  }
  main {
    margin-left: 0 !important;
  }
  body {
    background: white;
  }
}
</style>

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

