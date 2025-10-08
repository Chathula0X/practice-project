<!-- Include Alpine.js (for menu toggle) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo + Navigation Links -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="dashboard.php">
                        <img src="logo.png" alt="Logo" class="block h-9 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="dashboard.php" class="text-gray-700 hover:text-blue-600 font-medium px-3 py-2 text-sm">
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Right Side: User Menu -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Team Dropdown (Optional) -->
                <?php if (isset($_SESSION['team_name'])): ?>
                <div class="ms-3 relative" x-data="{ openTeam: false }">
                    <button @click="openTeam = !openTeam"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 transition">
                        <?= htmlspecialchars($_SESSION['team_name']); ?>
                        <svg class="ms-2 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="openTeam" @click.away="openTeam = false"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                        <a href="team-settings.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Team Settings</a>
                        <a href="create-team.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Create New Team</a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- User Dropdown -->
                <div class="ms-3 relative" x-data="{ openUser: false }">
                    <button @click="openUser = !openUser"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 transition">
                        <?php if (!empty($_SESSION['user_photo'])): ?>
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="<?= htmlspecialchars($_SESSION['user_photo']); ?>"
                                 alt="<?= htmlspecialchars($_SESSION['user_name']); ?>">
                        <?php else: ?>
                            <?= htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>
                        <?php endif; ?>

                        <svg class="ms-2 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="openUser" @click.away="openUser = false"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                        <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="api-tokens.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">API Tokens</a>
                        <div class="border-t border-gray-200"></div>
                        <form action="logout.php" method="POST">
                            <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="dashboard.php"
               class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-blue-600 hover:border-blue-600">
                Dashboard
            </a>
        </div>

        <!-- Responsive User Info -->
        <div class="pt-4 pb-1 border-t border-gray-200 px-4">
            <div class="flex items-center">
                <?php if (!empty($_SESSION['user_photo'])): ?>
                    <img class="h-10 w-10 rounded-full object-cover me-3"
                         src="<?= htmlspecialchars($_SESSION['user_photo']); ?>"
                         alt="<?= htmlspecialchars($_SESSION['user_name']); ?>">
                <?php endif; ?>
                <div>
                    <div class="font-medium text-base text-gray-800"><?= htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></div>
                    <div class="font-medium text-sm text-gray-500"><?= htmlspecialchars($_SESSION['user_email'] ?? ''); ?></div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="api-tokens.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">API Tokens</a>
                <form action="logout.php" method="POST">
                    <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
