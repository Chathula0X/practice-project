<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Itineraries</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md">
    <x-sidebar />
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8 bg-gray-50">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        Itineraries for Inquiry #{{ $inquiry->id }}
      </h1>
      <a href="{{ route('itinerary.create', $inquiry->id) }}"
         class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">
        + Create Itinerary
      </a>
    </div>

    <div class="bg-white shadow-md rounded-2xl overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Version</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Cost</th>
            <th class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($itineraries as $itinerary)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $itinerary->version }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $itinerary->title ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $itinerary->destination ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                {{ optional($itinerary->start_date)->format('Y-m-d') }}
                –
                {{ optional($itinerary->end_date)->format('Y-m-d') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                  {{ $itinerary->status }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${{ number_format($itinerary->total_cost ?? 0, 2) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="{{ route('itinerary.edit', $itinerary->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-8 text-center text-gray-500">No itineraries yet for this inquiry.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>
</div>

</body>
</html>


