<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Client Dashboard</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Sidebar section -->
  <aside class="w-64 bg-white shadow-md">
    <x-sidebar />
  </aside>

  <!-- Main content section -->
  <main class="flex-1 p-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Client</h1>
  
    <!-- Card box -->
    <div class="bg-white shadow-md rounded-2xl p-4 w-full max-w-7xl h-24 flex items-center justify-between mb-6">

      <!-- Left: Search Bar -->
      <div class="flex items-center">
        <input 
          type="text" 
          placeholder="Search clients..." 
          class="px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
        />
      </div>

      <!-- Right: Create Client Button -->
      <button onclick="openModal()" class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">
        + Create Client
      </button>

    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-2xl overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nationality</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preferences</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($clients as $client)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $client->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $client->email }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $client->phone }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $client->nationality }}</td>
            <td class="px-6 py-4">
              <div class="max-w-xs truncate" title="{{ $client->preferences }}">
                {{ $client->preferences ?? 'N/A' }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex gap-2">
                <a href="{{ route('inquiry.index', $client->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 inline-block text-center">Detail</a>
                <button onclick='openEditModal({{ $client->id }}, "{{ addslashes($client->name) }}", "{{ addslashes($client->email) }}", "{{ addslashes($client->phone) }}", "{{ addslashes($client->nationality) }}", {{ json_encode($client->preferences) }})' class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Edit</button>
                <form action="{{ route('client.delete', $client->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this client?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>

  </main>

</div>

<!-- Include Create Modal -->
@include('AdminDashboard.Client.create')

<!-- Include Edit Modal -->
@include('AdminDashboard.Client.edit')

<script>
  function openModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  }

  function closeModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
    document.body.style.overflow = 'auto'; // Restore background scrolling
  }

  function openEditModal(id, name, email, phone, nationality, preferences) {
    // Set form action with the client ID
    document.getElementById('editForm').action = `/client/${id}`;
    
    // Populate form fields
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_phone').value = phone;
    document.getElementById('edit_nationality').value = nationality;
    document.getElementById('edit_preferences').value = preferences || '';
    
    // Open modal
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
  }

  // Close modals when clicking outside the form
  document.getElementById('createModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeModal();
    }
  });

  document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeEditModal();
    }
  });

  // Auto-open modal if there are validation errors
  @if($errors->any())
    openModal();
  @endif
</script>

</body>
</html>
