<!-- Layout and Navigation -->
<html lang="id" x-data="{
    ...darkMode(),
    ...sidebar(),
    ...translate(),
    currentPage: 'home',
    setLanguage(lang) {
        this.currentLanguage = lang;
        localStorage.setItem('language', lang);
        document.documentElement.setAttribute('lang', lang);
        this.updatePageText(); // Update the content immediately
    },
    updatePageText() {
        document.querySelectorAll('[data-translate-key]').forEach((element) => {
            const key = element.getAttribute('data-translate-key');
            element.textContent = this.translations[this.currentLanguage][key];
        });
    }
}" x-init="document.documentElement.classList.toggle('dark', darkMode); document.documentElement.setAttribute('lang', currentLanguage)">
    
    <!-- Head -->
    @include('components.head')

    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
        <!-- Header -->
        <header class="p-4 bg-gray-100 dark:bg-gray-800 shadow-md">
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

                <!-- Navigation -->
                <nav class="hidden lg:flex lg:space-x-6">
                    <a href="#" x-on:click="currentPage = 'home'" 
                       :class="{ 'text-blue-500': currentPage === 'home' }" 
                       x-text="translations[currentLanguage].home"></a>
                    <a href="#" x-on:click="currentPage = 'about'" 
                       :class="{ 'text-blue-500': currentPage === 'about' }" 
                       x-text="translations[currentLanguage].about"></a>
                    <a href="#" x-on:click="currentPage = 'contact'" 
                       :class="{ 'text-blue-500': currentPage === 'contact' }" 
                       x-text="translations[currentLanguage].contact"></a>
                </nav>

                <!-- Mobile Sidebar Button -->
                <button x-on:click="toggleMenu" class="lg:hidden text-gray-800 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </header>

        <!-- Sidebar for Mobile -->
        @include('components.sidebar')

        <!-- Dynamic Content -->
        <main class="max-w-7xl mx-auto p-4">
            <div x-show="currentPage === 'home'">
                <h2 class="text-2xl font-bold" x-text="translations[currentLanguage].homeTitle"></h2>
                <p x-text="translations[currentLanguage].homeDescription"></p>
            </div>
            <div x-show="currentPage === 'about'">
                <h2 class="text-2xl font-bold" x-text="translations[currentLanguage].aboutTitle"></h2>
                <p x-text="translations[currentLanguage].aboutDescription"></p>
            </div>
            <div x-show="currentPage === 'contact'">
                <h2 class="text-2xl font-bold" x-text="translations[currentLanguage].contactTitle"></h2>
                <p x-text="translations[currentLanguage].contactDescription"></p>
            </div>
        </main>
    </body>
</html>


