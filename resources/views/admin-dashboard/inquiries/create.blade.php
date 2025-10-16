<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Add Inquiry</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md">
    <x-sidebar />
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8 bg-gray-50">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Add Inquiry for {{ $client->name }}</h2>
        <a href="{{ route('inquiry.index', $client->id) }}" 
           class="text-blue-600 hover:underline text-sm font-medium">← Back to Inquiries</a>
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

      <!-- Inquiry Form -->
      <form action="{{ route('inquiry.store', $client->id) }}" method="POST" class="space-y-5">
        @csrf

        <!-- Destination -->
        <div>
          <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
          <input type="text" id="destination" name="destination" value="{{ old('destination') }}" placeholder="Enter destination"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('destination') border-red-500 @enderror" required>
          @error('destination')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Start Date -->
        <div>
          <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
          <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('start_date') border-red-500 @enderror" required>
          @error('start_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- End Date -->
        <div>
          <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
          <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('end_date') border-red-500 @enderror" required>
          @error('end_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Budget -->
        <div>
          <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Budget</label>
          <input type="number" id="budget" name="budget" value="{{ old('budget') }}" placeholder="Enter budget (optional)"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('budget') border-red-500 @enderror">
          @error('budget')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Notes -->
        <div>
          <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
          <textarea id="note" name="note" rows="3" placeholder="Enter any additional notes"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none @error('note') border-red-500 @enderror">{{ old('note') }}</textarea>
          @error('note')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4">
          <button type="submit"
            class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition font-medium">
            Add Inquiry
          </button>
          <a href="{{ route('inquiry.index', $client->id) }}"
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
