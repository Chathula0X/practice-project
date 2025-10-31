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

  <main id="mainContent" class="ml-64 flex-1 p-6 md:p-10 bg-gray-50 transition-all duration-300 min-h-screen">
    
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 sticky top-0 bg-gray-50 pt-2 pb-4 z-30 border-b border-gray-200">
        <div class="flex items-center gap-4 mb-4 md:mb-0">
            <button onclick="toggleSidebar()" class="p-2 rounded-full bg-white border border-gray-200 shadow-sm hover:bg-gray-100 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500">
                <svg id="menuIcon" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">✈️ Trip Plans</h1>
                <p class="text-lg text-gray-500 mt-1">
                    Client: <span class="font-semibold text-gray-700">{{ $inquiry->client->name }}</span> | Destination: <span class="font-semibold text-purple-600">{{ $inquiry->destination }}</span>
                </p>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('inquiry.index', $inquiry->id) }}" 
               class="flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-medium text-sm shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Inquiries
            </a>
            <a href="{{ route('itinerary.create', $inquiry->id) }}" 
               class="flex items-center px-6 py-2 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-medium text-sm shadow-lg shadow-purple-200/50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Itinerary
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-8 shadow-md">
        <p class="text-green-800 font-medium">✅ Success: {{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white border-t-4 border-blue-500 rounded-2xl p-6 mb-10 shadow-xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Inquiry Overview
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="border-r border-gray-100 md:border-none">
                <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Dates</p>
                <p class="text-lg font-bold text-gray-900">{{ $inquiry->start_date }} → {{ $inquiry->end_date }}</p>
            </div>
            <div class="border-r border-gray-100 md:border-none">
                <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Budget</p>
                <p class="text-lg font-bold text-green-600">${{ number_format($inquiry->budget, 0) }}</p>
            </div>
            <div class="border-r border-gray-100 md:border-none">
                <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Client Contact</p>
                <p class="text-sm font-semibold text-gray-900 truncate px-2">{{ $inquiry->client->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Total Plans</p>
                <p class="text-lg font-bold text-purple-600">{{ $itineraries->count() }}</p>
            </div>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Proposed Itineraries ({{ $itineraries->count() }})</h2>

@if($itineraries->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($itineraries as $itinerary)
        <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition duration-300 ease-in-out flex flex-col">
            
            <div class="bg-gradient-to-r from-purple-600 to-indigo-700 p-4 flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-white leading-snug">{{ $itinerary->title }}</h3>
                    <p class="text-purple-200 text-sm mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $itinerary->destination }}
                    </p>
                </div>
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full self-start
                          {{ $itinerary->status === 'approved' ? 'bg-green-400 text-white shadow-md' : 
                            ($itinerary->status === 'rejected' ? 'bg-red-400 text-white shadow-md' : 
                            ($itinerary->status === 'pending' ? 'bg-yellow-400 text-gray-900 shadow-md' : 
                            'bg-gray-400 text-white shadow-md')) }}">
                    {{ ucfirst($itinerary->status) }}
                </span>
            </div>

            <div class="p-5 space-y-4 flex-grow">
                
                <div class="flex items-center text-sm text-gray-600 border-b border-gray-100 pb-3">
                    <svg class="w-5 h-5 mr-3 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium text-gray-800">{{ $itinerary->start_date }} → {{ $itinerary->end_date }}</span>
                    <span class="ml-auto text-xs font-semibold text-purple-600 bg-purple-100 px-3 py-1 rounded-full">
                        {{ Carbon\Carbon::parse($itinerary->start_date)->diffInDays(Carbon\Carbon::parse($itinerary->end_date)) }} days
                    </span>
                </div>

                <div class="space-y-2 text-sm">
                    <p class="text-sm font-semibold text-gray-700 mb-2 border-b border-dashed pb-2">Estimated Costs:</p>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 flex items-center">🏨 Accommodation:</span>
                        <span class="font-semibold text-gray-800">${{ number_format($itinerary->accommodation_total, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 flex items-center">🚗 Transport:</span>
                        <span class="font-semibold text-gray-800">${{ number_format($itinerary->transport_total, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 flex items-center">🎟️ Activities:</span>
                        <span class="font-semibold text-gray-800">${{ number_format($itinerary->activities_total, 0) }}</span>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                    <span class="text-lg text-gray-700 font-semibold">Total Cost:</span>
                    <span class="font-extrabold text-green-600 text-2xl">${{ number_format($itinerary->astimated_cost, 0) }}</span>
                </div>
            </div>

            <div class="p-4 bg-gray-50 border-t flex flex-col gap-2">
                <a href="{{ route('itinerary.show', $itinerary->id) }}" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center text-sm font-medium shadow-md">
                    <span class="flex items-center justify-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> View Details</span>
                </a>
                <div class="flex gap-2">
                    <a href="{{ route('itinerary.edit', $itinerary->id) }}" class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-center text-xs font-medium" title="Edit Itinerary">
                        Edit
                    </a>
                    <form action="{{ route('itinerary.delete', $itinerary->id) }}" method="POST" 
                          onsubmit="return confirm('⚠️ Are you sure you want to delete this itinerary?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-center text-xs font-medium" title="Delete Itinerary">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white border-4 border-dashed border-gray-200 rounded-2xl p-16 text-center mt-10 shadow-lg">
        <svg class="w-20 h-20 mx-auto text-purple-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h3 class="text-2xl font-bold text-gray-700 mb-3">Plan Awaits!</h3>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">It looks like there are no trip plans created for this client yet. Start designing the perfect journey now.</p>
        <a href="{{ route('itinerary.create', $inquiry->id) }}" class="inline-flex items-center px-8 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-semibold shadow-xl shadow-purple-200/50" title="Create First Itinerary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
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

