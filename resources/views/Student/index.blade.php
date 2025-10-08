<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body class="bg-[#F7FFF7] min-h-screen">
  @include('Navbar.navbar')
  
  <div class="flex justify-center items-center min-h-screen pt-16">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl overflow-hidden">
    <!-- Header with Create Button -->
    <div class="flex justify-between items-center p-6 border-b border-[#4ECDC4]">
      <h1 class="text-2xl font-bold text-[#2C3E50]">Students</h1>
      <a href="/student/create" class="bg-[#4ECDC4] hover:bg-[#1A535C] text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Create New
      </a>
    </div>
    <table class="table-auto w-full border-collapse">
      <thead class="bg-[#4ECDC4] text-white">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Age</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Gender</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Action</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-[#4ECDC4]/20">

        @foreach($students as $student)

        <tr class="hover:bg-[#4ECDC4]/5 transition">
          <td class="px-6 py-4 text-[#2C3E50]">{{ $student->id }}</td>
          <td class="px-6 py-4 text-[#2C3E50]">{{ $student->name }}</td>
          <td class="px-6 py-4 text-[#2C3E50]/80">{{ $student->email }}</td>
          <td class="px-6 py-4 text-[#2C3E50]/70">{{ $student->age }}</td>
          <td class="px-6 py-4 text-[#2C3E50]/70">{{ $student->gender }}</td>
          <td class="px-6 py-4 text-[#2C3E50]/70">
            <div class="flex gap-2">
              <a href="{{route('student.edit', $student->id)}}" class="bg-[#FFE66D] text-[#1A535C] px-3 py-1 rounded hover:bg-[#FFE66D]/90 text-sm">Edit</a>
              <form action="{{route('student.delete', $student->id)}}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</body>
</html>