<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Create Itinerary</title>
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
            <h1 class="text-3xl font-bold text-gray-800">Create New Itinerary</h1>
            <p class="text-gray-600 mt-1">For {{ $inquiry->client->name }} - {{ $inquiry->destination }}</p>
          </div>
        </div>
        <a href="{{ route('itinerary.index', $inquiry->id) }}" 
           class="px-6 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition font-medium">
          ← Back
        </a>
      </div>

      <!-- Error Display -->
      @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
          <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" 
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" 
                clip-rule="evenodd"></path>
            </svg>
            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
          </div>
          <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
              <li class="text-sm text-red-700">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('itinerary.store', $inquiry->id) }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">

        <!-- Basic Information Section -->
        <div class="bg-white shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
              <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
            Basic Information
          </h2>
          
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Itinerary Title *</label>
              <input type="text" id="title" name="title" value="{{ old('title') }}" 
                     placeholder="e.g., Bali Adventure Package"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none @error('title') border-red-500 @enderror" required>
              @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">Destination *</label>
              <input type="text" id="destination" name="destination" 
                     value="{{ old('destination', $inquiry->destination) }}" 
                     placeholder="Enter destination"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none @error('destination') border-red-500 @enderror" required>
              @error('destination')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Date Selector Section -->
        <div class="bg-blue-50 border-l-4 border-blue-500 shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
            </svg>
            Date Range
          </h2>
          
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
              <input type="date" id="start_date" name="start_date" 
                     value="{{ old('start_date', $inquiry->start_date) }}" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('start_date') border-red-500 @enderror" required>
              @error('start_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
              <input type="date" id="end_date" name="end_date" 
                     value="{{ old('end_date', $inquiry->end_date) }}" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('end_date') border-red-500 @enderror" required>
              @error('end_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Accommodation Planner Section -->
        <div class="bg-purple-50 border-l-4 border-purple-500 shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Accommodation Details
          </h2>
          
          <div class="space-y-4">
            <div>
              <label for="accommodation_hotel_name" class="block text-sm font-medium text-gray-700 mb-1">Hotel Name</label>
              <input type="text" id="accommodation_hotel_name" name="accommodation[hotel_name]" 
                     value="{{ old('accommodation.hotel_name') }}" 
                     placeholder="e.g., Grand Hyatt"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-3 gap-4">
              <div>
                <label for="accommodation_room_type" class="block text-sm font-medium text-gray-700 mb-1">Room Type</label>
                <select id="accommodation_room_type" name="accommodation[room_type]"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                  <option value="">Select Type</option>
                  <option value="standard">Standard</option>
                  <option value="deluxe">Deluxe</option>
                  <option value="suite">Suite</option>
                  <option value="villa">Villa</option>
                </select>
              </div>

              <div>
                <label for="accommodation_nights" class="block text-sm font-medium text-gray-700 mb-1">Number of Nights</label>
                <input type="number" id="accommodation_nights" name="accommodation[nights]" 
                       value="{{ old('accommodation.nights') }}" 
                       min="1" placeholder="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none"
                       oninput="calculateBudget()">
              </div>

              <div>
                <label for="accommodation_cost_per_night" class="block text-sm font-medium text-gray-700 mb-1">Cost per Night ($)</label>
                <input type="number" id="accommodation_cost_per_night" name="accommodation[cost_per_night]" 
                       value="{{ old('accommodation.cost_per_night') }}" 
                       step="0.01" min="0" placeholder="0.00"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none"
                       oninput="calculateBudget()">
              </div>
            </div>
          </div>
        </div>

        <!-- Transport Details Section -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
              <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
            </svg>
            Transport Details
          </h2>
          
          <div class="space-y-4">
            <div>
              <label for="transport_type" class="block text-sm font-medium text-gray-700 mb-1">Transport Type</label>
              <select id="transport_type" name="transport[type]"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                <option value="">Select Type</option>
                <option value="flight">Flight</option>
                <option value="car_rental">Car Rental</option>
                <option value="bus">Bus</option>
                <option value="train">Train</option>
                <option value="private_transfer">Private Transfer</option>
              </select>
            </div>

            <div class="grid grid-cols-3 gap-4">
              <div>
                <label for="transport_from" class="block text-sm font-medium text-gray-700 mb-1">From</label>
                <input type="text" id="transport_from" name="transport[from]" 
                       value="{{ old('transport.from') }}" 
                       placeholder="Departure location"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none">
              </div>

              <div>
                <label for="transport_to" class="block text-sm font-medium text-gray-700 mb-1">To</label>
                <input type="text" id="transport_to" name="transport[to]" 
                       value="{{ old('transport.to') }}" 
                       placeholder="Arrival location"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none">
              </div>

              <div>
                <label for="transport_cost" class="block text-sm font-medium text-gray-700 mb-1">Transport Cost ($)</label>
                <input type="number" id="transport_cost" name="transport[cost]" 
                       value="{{ old('transport.cost') }}" 
                       step="0.01" min="0" placeholder="0.00"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                       oninput="calculateBudget()">
              </div>
            </div>
          </div>
        </div>

        <!-- Activities / Events Section -->
        <div class="bg-pink-50 border-l-4 border-pink-500 shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
            </svg>
            Activities & Events
          </h2>
          
          <div id="activities-container" class="space-y-3">
            <div class="activity-item grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Activity Name</label>
                <input type="text" name="activities[0][name]" 
                       value="{{ old('activities.0.name') }}" 
                       placeholder="e.g., Scuba Diving"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:outline-none">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cost ($)</label>
                <input type="number" name="activities[0][cost]" 
                       value="{{ old('activities.0.cost') }}" 
                       step="0.01" min="0" placeholder="0.00"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:outline-none"
                       oninput="calculateBudget()">
              </div>
            </div>
          </div>
          
          <button type="button" onclick="addActivity()" 
                  class="mt-4 px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition font-medium">
            + Add Another Activity
          </button>
        </div>

        <!-- Budget Estimator Section -->
        <div class="bg-gradient-to-r from-green-50 to-blue-50 border-l-4 border-green-500 shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
            </svg>
            Budget Summary
          </h2>
          
          <div class="space-y-3">
            <div class="flex justify-between items-center p-3 bg-white rounded-lg">
              <span class="text-gray-700 font-medium">Accommodation Total:</span>
              <span id="accommodation_total" class="font-bold text-gray-900 text-lg">$0.00</span>
            </div>
            <div class="flex justify-between items-center p-3 bg-white rounded-lg">
              <span class="text-gray-700 font-medium">Transport Total:</span>
              <span id="transport_total" class="font-bold text-gray-900 text-lg">$0.00</span>
            </div>
            <div class="flex justify-between items-center p-3 bg-white rounded-lg">
              <span class="text-gray-700 font-medium">Activities Total:</span>
              <span id="activities_total" class="font-bold text-gray-900 text-lg">$0.00</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-gradient-to-r from-green-100 to-blue-100 rounded-lg border-2 border-green-400">
              <span class="text-lg font-bold text-gray-800">Grand Total:</span>
              <span id="grand_total" class="text-3xl font-bold text-green-600">$0.00</span>
            </div>
            <input type="hidden" name="total_cost" id="total_cost" value="0">
          </div>
        </div>

        <!-- Additional Notes Section -->
        <div class="bg-white shadow-md rounded-2xl p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Additional Notes</h2>
          <textarea id="notes" name="notes" rows="4" 
                    placeholder="Add any special requests, dietary requirements, or important notes..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">{{ old('notes') }}</textarea>
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-4 bg-white p-6 rounded-2xl shadow-md">
          <button type="submit" 
                  class="px-8 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-semibold shadow-lg">
                  Create Itinerary
          </button>
          <a href="{{ route('itinerary.index', $inquiry->id) }}" 
             class="px-8 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition font-medium text-center">
            Cancel
          </a>
        </div>
      </form>

    </div>
  </main>
</div>

<script>
let activityCount = 1;

function addActivity() {
  const container = document.getElementById('activities-container');
  const activityItem = document.createElement('div');
  activityItem.className = 'activity-item grid grid-cols-2 gap-4';
  activityItem.innerHTML = `
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Activity Name</label>
      <input type="text" name="activities[${activityCount}][name]" 
             placeholder="e.g., City Tour"
             class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:outline-none">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Cost ($)</label>
      <input type="number" name="activities[${activityCount}][cost]" 
             step="0.01" min="0" placeholder="0.00"
             class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:outline-none"
             oninput="calculateBudget()">
    </div>
  `;
  container.appendChild(activityItem);
  activityCount++;
}

function calculateBudget() {
  // Accommodation
  const nights = parseFloat(document.getElementById('accommodation_nights')?.value) || 0;
  const costPerNight = parseFloat(document.getElementById('accommodation_cost_per_night')?.value) || 0;
  const accommodationTotal = nights * costPerNight;
  
  // Transport
  const transportCost = parseFloat(document.getElementById('transport_cost')?.value) || 0;
  
  // Activities
  const activityInputs = document.querySelectorAll('input[name^="activities"][name$="[cost]"]');
  let activitiesTotal = 0;
  activityInputs.forEach(input => {
    activitiesTotal += parseFloat(input.value) || 0;
  });
  
  // Update UI
  document.getElementById('accommodation_total').textContent = '$' + accommodationTotal.toFixed(2);
  document.getElementById('transport_total').textContent = '$' + transportCost.toFixed(2);
  document.getElementById('activities_total').textContent = '$' + activitiesTotal.toFixed(2);
  
  const grandTotal = accommodationTotal + transportCost + activitiesTotal;
  document.getElementById('grand_total').textContent = '$' + grandTotal.toFixed(2);
  document.getElementById('total_cost').value = grandTotal;
}

// Initialize budget calculation on page load
document.addEventListener('DOMContentLoaded', function() {
  calculateBudget();
});

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

