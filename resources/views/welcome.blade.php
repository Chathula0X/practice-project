<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>StudentP - Welcome</title>
</head>
<body class="bg-[#F7FFF7] min-h-screen">
    <!-- Toast Notification -->
    <x-toast />
    
    @include('Navbar.navbar')
    
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#4ECDC4] to-[#1A535C] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Welcome to StudentP</h1>
                <p class="text-xl md:text-2xl mb-8 text-[#F7FFF7]">Manage your students with ease and efficiency</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('student.index') }}" class="bg-white text-[#1A535C] hover:bg-[#F7FFF7] font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-200 ease-in-out transform hover:scale-105">
                        View Students
                    </a>
                    <a href="{{ route('student.create') }}" class="bg-[#FFE66D] hover:bg-[#FFE66D]/90 text-[#1A535C] font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-200 ease-in-out transform hover:scale-105">
                        Add New Student
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-[#2C3E50] mb-4">Why Choose StudentP?</h2>
            <p class="text-lg text-[#2C3E50]/80">A comprehensive student management system designed for modern educational institutions</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="text-[#4ECDC4] mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#2C3E50] mb-2">Student Management</h3>
                <p class="text-[#2C3E50]/80">Easily add, edit, and manage student information with our intuitive interface.</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="text-[#4ECDC4] mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#2C3E50] mb-2">Secure & Reliable</h3>
                <p class="text-[#2C3E50]/80">Your data is protected with enterprise-grade security and regular backups.</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="text-[#4ECDC4] mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#2C3E50] mb-2">Fast & Efficient</h3>
                <p class="text-[#2C3E50]/80">Quick access to student data with lightning-fast search and filtering capabilities.</p>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#2C3E50] mb-4">About StudentP</h2>
                <p class="text-lg text-[#2C3E50]/80 max-w-3xl mx-auto">
                    StudentP is a modern, web-based student management system built with Laravel and Tailwind CSS. 
                    It provides educational institutions with a powerful tool to manage student information, 
                    track academic progress, and maintain comprehensive records.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-semibold text-[#2C3E50] mb-4">Key Features</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-[#2C3E50]/80">
                            <svg class="w-5 h-5 text-[#4ECDC4] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Student Registration & Management
                        </li>
                        <li class="flex items-center text-[#2C3E50]/80">
                            <svg class="w-5 h-5 text-[#4ECDC4] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Responsive Design for All Devices
                        </li>
                        <li class="flex items-center text-[#2C3E50]/80">
                            <svg class="w-5 h-5 text-[#4ECDC4] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Secure Admin Authentication
                        </li>
                        <li class="flex items-center text-[#2C3E50]/80">
                            <svg class="w-5 h-5 text-[#4ECDC4] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Easy Data Export & Reporting
                        </li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-[#4ECDC4]/20 to-[#1A535C]/20 p-8 rounded-2xl">
                    <div class="text-center">
                        <div class="text-6xl font-bold text-[#1A535C] mb-4">100+</div>
                        <div class="text-xl text-[#2C3E50]">Students Managed</div>
                        <div class="text-sm text-[#2C3E50]/60 mt-2">And counting...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1A535C] text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 StudentP. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>