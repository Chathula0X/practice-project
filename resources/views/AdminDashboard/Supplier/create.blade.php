<!-- Create Supplier Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4 p-6"> <!-- Increased width and removed max-height -->
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Create New Supplier</h2>
      <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <form action="{{ route('supplier.store') }}" method="POST" class="space-y-5">
      @csrf
    
      @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
          <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
          </div>
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
              <li class="text-sm text-red-700">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    
      <!-- Supplier Name -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Supplier Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter supplier name" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('name') border-red-500 @enderror">
        @error('name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      
      <!-- Supplier Type (Dropdown) -->
      <div>
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
        <select id="type" name="type"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('type') border-red-500 @enderror">
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
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('email') border-red-500 @enderror">
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Location -->
      <div>
        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('location') border-red-500 @enderror">
        @error('location')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Notes -->
      <div>
        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
        <textarea id="notes" name="notes" rows="3" placeholder="Enter additional notes"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
        @error('notes')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Action Buttons -->
      <div class="flex gap-3 pt-4">
        <button type="submit"
          class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition font-medium">
          Create Supplier
        </button>
        <button type="button" onclick="closeModal()"
          class="flex-1 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition font-medium">
          Cancel
        </button>
      </div>
    </form>

  </div>
</div>
