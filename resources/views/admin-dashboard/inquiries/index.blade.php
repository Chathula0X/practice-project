<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Client Inquiries</title>
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
        Inquiries for {{ $client->name }}
      </h1>
      <a href="{{ route('inquiry.create', $client->id) }}" 
         class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">
        + Add New Inquiry
      </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white shadow-md rounded-2xl overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($client->inquiries as $inquiry)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->destination }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->start_date }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->end_date }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inquiry->budget }}</td>
            <td class="px-6 py-4 max-w-xs truncate" title="{{ $inquiry->note }}">{{ $inquiry->note ?? 'N/A' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex gap-2">
                <a href="{{ route('inquiry.edit', $inquiry->id) }}" 
                   class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Edit</a>
                
                <form action="{{ route('inquiry.delete', $inquiry->id) }}" method="POST" 
                      onsubmit="return confirm('Delete this inquiry?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @if($client->inquiries->isEmpty())
      <div class="text-center text-gray-500 py-8">No inquiries found for this client.</div>
      @endif
    </div>

  </main>
</div>

</body>
</html>
