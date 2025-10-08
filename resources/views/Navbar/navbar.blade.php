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
                <a href="{{ route('admin.login') }}" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 ease-in-out">
                    Login
                </a>
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
                <a href="{{ route('admin.login') }}" class="text-[#2C3E50] hover:text-[#4ECDC4] hover:bg-[#4ECDC4]/10 block px-4 py-3 rounded-lg text-base font-medium transition duration-200 ease-in-out">
                    Login
                </a>
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
});
</script>