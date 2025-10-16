<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Supplier Management</title>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
  
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md">
    <x-sidebar />
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Supplier</h1>

    <!-- Card Box -->
    <div class="bg-white shadow-md rounded-2xl p-4 w-full max-w-7xl h-24 flex items-center justify-between mb-6">
      <!-- Search Bar -->
      <div class="flex items-center">
        <input 
          type="text" 
          placeholder="Search suppliers..." 
          class="px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
        />
      </div>

      <!-- Create Supplier Button -->
      <button onclick="openModal()" class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">
        + Create Supplier
      </button>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-2xl overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($suppliers as $supplier)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->type }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->email }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->location }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->notes }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex gap-2">
                <button 
                  onclick="openEditModal({{ $supplier->id }}, '{{ addslashes($supplier->name) }}', '{{ addslashes($supplier->type) }}', '{{ addslashes($supplier->email) }}', '{{ addslashes($supplier->location) }}', '{{ addslashes($supplier->notes ?? '') }}')" 
                  class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                  Edit
                </button>
                <form 
                  action="{{ route('supplier.delete', $supplier->id) }}" 
                  method="POST" 
                  class="inline" 
                  onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
@include('admin-dashboard.Supplier.create')

<!-- Include Edit Modal -->
@include('admin-dashboard.Supplier.edit')

<script>
  function openModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
  }

  function openEditModal(id, name, type, email, location, notes) {
    document.getElementById('editForm').action = `/supplier/${id}`;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_location').value = location;
    document.getElementById('edit_notes').value = notes;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
  }

  document.getElementById('createModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });

  document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
  });

  @if($errors->any())
    openModal();
  @endif
</script>

</body>
</html>
