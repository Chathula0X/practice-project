<!-- Create Client Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
      <h2 class="text-2xl font-bold text-gray-800">Create New Client</h2>
      <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6">
      <form action="{{ route('client.store') }}" method="POST" class="space-y-5">
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
      
        <!-- Client Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter client name" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('name') border-red-500 @enderror">
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        
        <!-- Client Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('email') border-red-500 @enderror">
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Client Phone -->
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
          <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('phone') border-red-500 @enderror">
          @error('phone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Country -->
        <div>
          <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
          <input type="text" id="country" name="country" value="{{ old('country') }}" placeholder="Enter country"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('country') border-red-500 @enderror">
          @error('country')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-4">
          <button type="submit"
            class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition font-medium">
            Create Client
          </button>
          <button type="button" onclick="closeModal()"
            class="flex-1 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition font-medium">
            Cancel
          </button>
        </div>
      </form>
    </div>

  </div>
</div>
