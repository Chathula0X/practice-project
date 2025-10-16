<nav class="bg-[#F7FFF7] shadow-lg sticky top-0 z-50 border-b border-[#4ECDC4]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo/Brand -->
            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="flex-shrink-0 flex items-center group">
                    <div class="bg-[#4ECDC4] text-white p-2 rounded-lg mr-3 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-[#1A535C]">StudentP</span>
                </a>
            </div>

            <!-- Desktop Navigation Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('welcome') }}" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out">
                    Home
                </a>
                <a href="#about" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out">
                    About
                </a>
                <a href="{{ route('student.index') }}" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out">
                    Students
                </a>
                <a href="{{ route('student.create') }}" class="bg-[#4ECDC4] hover:bg-[#1A535C] text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out transform hover:scale-105 shadow-md">
                    Create Student
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-3">
                <!-- Login Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out flex items-center">
                        Login
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="py-1">
                            <a href="{{ route('admin.login') }}" class="block px-4 py-2 text-sm text-[#2C3E50] hover:bg-[#4ECDC4]/10 hover:text-[#4ECDC4] transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Admin Login
                                </div>
                            </a>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-[#2C3E50] hover:bg-[#4ECDC4]/10 hover:text-[#4ECDC4] transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    User Login
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('register') }}" class="bg-[#FFE66D] hover:bg-[#FFE66D]/90 text-[#1A535C] px-6 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out transform hover:scale-105 shadow-md">
                    Register
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="mobile-menu-button text-[#2C3E50] hover:text-[#4ECDC4] focus:outline-none focus:text-[#4ECDC4] p-2 rounded-lg hover:bg-[#4ECDC4]/10 transition duration-200" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden" id="mobile-menu">
        <div class="px-4 pt-2 pb-3 space-y-1 bg-[#F7FFF7] border-t border-[#4ECDC4]">
            <a href="{{ route('welcome') }}" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 block px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out">
                Home
            </a>
            <a href="#about" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 block px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out">
                About
            </a>
            <a href="{{ route('student.index') }}" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 block px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out">
                Students
            </a>
            <a href="{{ route('student.create') }}" class="bg-[#4ECDC4] hover:bg-[#1A535C] text-white block px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out shadow-md">
                Create Student
            </a>
            <div class="border-t border-[#4ECDC4] pt-4 mt-4">
                <!-- Mobile Login Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="w-full text-left text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out flex items-center justify-between">
                        <span>Login</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Mobile Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 ml-4 bg-white rounded-lg shadow-lg border border-gray-200">
                        <div class="py-1">
                            <a href="{{ route('admin.login') }}" class="block px-4 py-3 text-sm text-[#2C3E50] hover:bg-[#4ECDC4]/10 hover:text-[#4ECDC4] transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Admin Login
                                </div>
                            </a>
                            <a href="{{ route('login') }}" class="block px-4 py-3 text-sm text-[#2C3E50] hover:bg-[#4ECDC4]/10 hover:text-[#4ECDC4] transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    User Login
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('register') }}" class="bg-[#FFE66D] hover:bg-[#FFE66D]/90 text-[#1A535C] block px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out mt-2 shadow-md">
                    Register
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript for mobile menu toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'true');
            } else {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    }
});
</script>