<!DOCTYPE html>
<html lang="id" x-data="{
    ...darkMode(),
    ...sidebar(),
    ...translate(),
    currentPage: 'home', // Default ke 'home'
    showModal: false,
}" 
x-init="
    if (localStorage.getItem('currentPage')) {
        currentPage = localStorage.getItem('currentPage');
    }
    document.documentElement.classList.toggle('dark', darkMode);
    loadTranslations();
    updatePageText();
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

                <!-- Mobile Menu Toggle -->
                <button x-on:click="toggleMenu" class="lg:hidden p-2 text-gray-800 dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex lg:space-x-6">
                    <a href="#" x-on:click.prevent="currentPage = 'home'" 
                       :class="currentPage === 'home' ? 'text-blue-500 font-semibold' : 'text-gray-700 dark:text-gray-300'" 
                       class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors"
                       data-translate-key="home">{{ __('messages.home') }}</a>
                    <a href="#" x-on:click.prevent="currentPage = 'about'" 
                       :class="currentPage === 'about' ? 'text-blue-500 font-semibold' : 'text-gray-700 dark:text-gray-300'" 
                       class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors"
                       data-translate-key="about">{{ __('messages.about') }}</a>
                    <a href="#" x-on:click.prevent="currentPage = 'contact'" 
                       :class="currentPage === 'contact' ? 'text-blue-500 font-semibold' : 'text-gray-700 dark:text-gray-300'" 
                       class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors"
                       data-translate-key="contact">{{ __('messages.contact') }}</a>
                </nav>
            </div>
        </header>

        <!-- Sidebar (Mobile) -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto p-4 pt-16">
            <!-- Home Page -->
            <section x-show="currentPage === 'home'" x-cloak class="transition-all duration-300 ease-in-out">
                @include('studenthome.home')
            </section>

            <!-- About Page -->
            <section x-show="currentPage === 'about'" x-cloak class="transition-all duration-300 ease-in-out">
                @include('studenthome.about')
            </section>

            <!-- Contact Page -->
            <section x-show="currentPage === 'contact'" x-cloak class="transition-all duration-300 ease-in-out">
                @include('studenthome.contact')
            </section>
        </main>
    </body>
</html>
