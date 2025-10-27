<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Create Supplier</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Fixed Sidebar -->
  <aside id="sidebar" class="w-64 bg-white shadow-md fixed left-0 top-0 h-screen overflow-y-auto transition-all duration-300 z-40">
    <x-sidebar />
  </aside>

  <!-- Main Content -->
  <main id="mainContent" class="ml-64 flex-1 p-8 bg-gray-50 w-full transition-all duration-300">
    <div class="max-w-3xl mx-auto">
      
      <!-- Header with Toggle Button -->
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
          <!-- Toggle Sidebar Button -->
          <button onclick="toggleSidebar()" class="p-2 rounded-lg bg-white shadow-md hover:bg-gray-50 transition">
            <svg id="menuIcon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
          <h1 class="text-3xl font-bold text-gray-800">Create New Supplier</h1>
        </div>
        <a href="{{ route('supplier.index') }}" 
           class="px-6 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition font-medium">
          ← Back to Suppliers
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

      <!-- Form Card -->
      <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('supplier.store') }}" method="POST" class="space-y-5">
          @csrf
        
          <!-- Supplier Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Supplier Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter supplier name" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('name') border-red-500 @enderror" required>
            @error('name')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <!-- Supplier Type -->
          <div>
            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
            <select id="type" name="type"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('type') border-red-500 @enderror" required>
              <option value="" disabled selected>Select supplier type</option>
              <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
              <option value="Transport" {{ old('type') == 'Transport' ? 'selected' : '' }}>Transport</option>
              <option value="Tour Company" {{ old('type') == 'Tour Company' ? 'selected' : '' }}>Tour Company</option>
            </select>
            @error('type')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Supplier Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('email') border-red-500 @enderror" required>
            @error('email')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Location -->
          <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('location') border-red-500 @enderror" required>
            @error('location')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Notes -->
          <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Enter additional notes (optional)"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
            @error('notes')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Action Buttons -->
          <div class="flex gap-3 pt-4">
            <button type="submit"
              class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition font-semibold">
              Create Supplier
            </button>
            <a href="{{ route('supplier.index') }}"
              class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 transition font-semibold text-center">
              Cancel
            </a>
          </div>
        </form>
      </div>

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
