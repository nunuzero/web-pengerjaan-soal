<!DOCTYPE html>
<html lang="id" x-data="{
    ...darkMode(),
    ...translate(),
    currentPage: localStorage.getItem('currentPage') || 'dashboard', // Default ke 'dashboard'
    showDropdown: false
}" x-init="
    document.documentElement.classList.toggle('dark', darkMode);
    loadTranslations();
    updatePageText();
    if (!localStorage.getItem('currentPage')) {
        currentPage = 'dashboard'; // Set default ke 'dashboard' jika belum ada di localStorage
    }
    $watch('currentPage', (value) => localStorage.setItem('currentPage', value)); 
">
    <!-- Head Section -->
    @include('components.head')

    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
        <!-- Header Section -->
        <header class="p-4 bg-gray-100 dark:bg-gray-800 shadow-md fixed top-0 left-0 w-full z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">L</div>
                    <h1 class="text-lg font-bold">Examite</h1>
                </div>

                <!-- Translate Dropdown -->
                @include('components.translate')

                <!-- Dark/Light Mode Toggle -->
                @include('components.dark-mode')

                <!-- User Menu -->
                <div class="relative">
                    <button 
                        x-on:click="showDropdown = !showDropdown" 
                        class="relative h-10 w-10 rounded-full focus:outline-none transition-transform transform hover:scale-105 active:scale-95 overflow-hidden shadow-lg">
                        <img 
                            src="{{ asset('images/profile-icon.png') }}"  
                            alt="User Avatar" 
                            class="absolute inset-0 w-full h-full object-cover rounded-full">
                    </button>

                    <!-- Dropdown Menu -->
                    <div 
                        x-show="showDropdown" 
                        x-on:click.away="showDropdown = false" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg z-50 overflow-hidden"
                    >
                        <a href="#" 
                           x-on:click.prevent="currentPage = 'dashboard'" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" 
                           data-translate-key="dashboard">
                           {{ __('messages.dashboard') }}
                        </a>
                        <a href="#" 
                           x-on:click.prevent="currentPage = 'profile'" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" 
                           data-translate-key="profile">
                           {{ __('messages.profile') }}
                        </a>
                        <a href="#" 
                           x-on:click.prevent="currentPage = 'result'" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" 
                           data-translate-key="result">
                           {{ __('messages.result') }}
                        </a>
                        <a href="{{ route('logout') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" 
                           data-translate-key="logout">
                           {{ __('messages.logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto p-4 pt-16">
            <!-- Dashboard Page -->
            <section x-show="currentPage === 'dashboard'" x-cloak>
                @include('studentboard.dashboard')
            </section>

            <!-- Profile Page -->
            <section x-show="currentPage === 'profile'" x-cloak>
                @include('studentboard.profile')
            </section>

            <!-- Result Page -->
            <section x-show="currentPage === 'result'" x-cloak>
                @include('studentboard.result')
            </section>
        </main>
    </body>
    <script>
    // Synchronize profile icon across pages using localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const savedPhoto = localStorage.getItem('profilePhoto');
        if (savedPhoto) {
            const icons = document.querySelectorAll('.global-profile-icon');
            icons.forEach(icon => {
                icon.src = savedPhoto;
            });
        }
    });
    </script>
</html>
