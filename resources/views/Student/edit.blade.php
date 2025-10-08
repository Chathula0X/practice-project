<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Edit Student</title>
</head>
<body class="bg-[#F7FFF7] min-h-screen">
  @include('Navbar.navbar')
  
  <div class="flex justify-center items-center min-h-screen pt-16">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
    <h1 class="text-2xl font-bold text-[#2C3E50] mb-6 text-center">Edit Student</h1>

    
    <form action="{{ route('student.update', $student->id) }}" method="POST" class="space-y-5">
        @method('PUT')
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
      <!-- Student Name -->
      <div>
        <label for="name" class="block text-sm font-medium text-[#2C3E50] mb-1">Student Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" placeholder="Enter student name" 
          class="w-full px-4 py-2 border border-[#4ECDC4] rounded-lg focus:ring-2 focus:ring-[#4ECDC4] focus:outline-none @error('name') border-red-500 @enderror">
        @error('name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      
      <!-- Student Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-[#2C3E50] mb-1">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" placeholder="Enter email address"
          class="w-full px-4 py-2 border border-[#4ECDC4] rounded-lg focus:ring-2 focus:ring-[#4ECDC4] focus:outline-none @error('email') border-red-500 @enderror">
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Student Age -->
      <div>
        <label for="age" class="block text-sm font-medium text-[#2C3E50] mb-1">Age</label>
        <input type="number" id="age" name="age" value="{{ old('age', $student->age) }}" placeholder="Enter age"
          class="w-full px-4 py-2 border border-[#4ECDC4] rounded-lg focus:ring-2 focus:ring-[#4ECDC4] focus:outline-none @error('age') border-red-500 @enderror">
        @error('age')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Gender -->
      <div>
        <label class="block text-sm font-medium text-[#2C3E50] mb-1">Gender</label>
        <select name="gender" id="gender"
          class="w-full px-4 py-2 border border-[#4ECDC4] rounded-lg focus:ring-2 focus:ring-[#4ECDC4] focus:outline-none @error('gender') border-red-500 @enderror">
          <option value="">Select gender</option>
          <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
          <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('gender')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit"
          class="w-full bg-[#4ECDC4] text-white py-2 px-4 rounded-lg hover:bg-[#1A535C] transition">
          Update Student
        </button>
      </div>
    </form>
    </div>
  </div>

</body>
</html>
