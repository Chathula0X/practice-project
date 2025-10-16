<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Edit Inquiry</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

  <!-- Layout Wrapper -->
  <div class="flex min-h-screen">

    <!-- Sidebar (Fixed) -->
    <aside class="fixed top-0 left-0 h-full w-64 bg-white shadow-md z-10">
      <x-sidebar />
    </aside>

    <!-- Main Content (Scrollable) -->
    <main class="ml-64 flex-1 overflow-y-auto p-8 bg-gray-50 min-h-screen">
      
      <!-- Header -->
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
          Edit Inquiry for <span class="text-blue-600">{{ $inquiry->client->name }}</span>
        </h1>
        <a href="{{ route('inquiry.index', $inquiry->client->id) }}" 
           class="px-6 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition font-medium">
          ← Back to Inquiries
        </a>
      </div>

      <!-- Form Card -->
      <div class="bg-white shadow-md rounded-2xl p-8 max-w-3xl mx-auto">
        <form action="{{ route('inquiry.update', $inquiry->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
              <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
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

          <!-- Destination -->
          <div>
            <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
            <input type="text" id="destination" name="destination" value="{{ $inquiry->destination }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
          </div>

          <!-- Start Date -->
          <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" id="start_date" name="start_date" value="{{ $inquiry->start_date }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
          </div>

          <!-- End Date -->
          <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" id="end_date" name="end_date" value="{{ $inquiry->end_date }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
          </div>

          <!-- Budget -->
          <div>
            <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Budget</label>
            <input type="number" id="budget" name="budget" value="{{ $inquiry->budget }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
          </div>

          <!-- Notes -->
          <div>
            <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea id="note" name="note" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none resize-none">{{ $inquiry->note }}</textarea>
          </div>

          <!-- Action Buttons -->
          <div class="flex gap-3 pt-4">
            <button type="submit"
                    class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition font-medium">
              Update Inquiry
            </button>
            <a href="{{ route('inquiry.index', $inquiry->client->id) }}"
               class="flex-1 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition font-medium text-center">
              Cancel
            </a>
          </div>
        </form>
      </div>

    </main>
  </div>

</body>
</html>
