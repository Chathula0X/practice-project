<!-- Edit Client Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
      <h2 class="text-2xl font-bold text-gray-800">Edit Client</h2>
      <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6">
      <form id="editForm" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
      
        <!-- Client Name -->
        <div>
          <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
          <input type="text" id="edit_name" name="name" placeholder="Enter client name" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none" required>
        </div>
        
        <!-- Client Email -->
        <div>
          <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" id="edit_email" name="email" placeholder="Enter email address"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none" required>
        </div>

        <!-- Client Phone -->
        <div>
          <label for="edit_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
          <input type="text" id="edit_phone" name="phone" placeholder="Enter phone number"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none" required>
        </div>

        <!-- Country -->
        <div>
          <label for="edit_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
          <input type="text" id="edit_country" name="country" placeholder="Enter country"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none" required>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-4">
          <button type="submit"
            class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition font-medium">
            Update Client
          </button>
          <button type="button" onclick="closeEditModal()"
            class="flex-1 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition font-medium">
            Cancel
          </button>
        </div>
      </form>
    </div>

  </div>
</div>
