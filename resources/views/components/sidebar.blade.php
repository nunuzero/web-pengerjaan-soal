<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebar', () => ({
            menuOpen: false,
            currentPage: 'home', // Pastikan currentPage ada di sidebar
            toggleMenu() {
                this.menuOpen = !this.menuOpen;
            },
        }));
    });
</script>

<!-- Sidebar for Mobile -->
<div x-show="menuOpen" 
     x-transition:enter="transition ease-out duration-200" 
     x-transition:leave="transition ease-in duration-150"
     class="fixed inset-0 bg-gray-800 bg-opacity-75 lg:hidden">
    <div class="absolute top-0 left-0 w-64 h-full bg-white dark:bg-gray-900 shadow-md p-4">
        <button x-on:click="menuOpen = false" class="text-gray-800 dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <nav class="mt-4 space-y-4">
            <a href="#" x-on:click="currentPage = 'home'; menuOpen = false" 
               :class="{ 'text-blue-500': currentPage === 'home' }" 
               x-text="translations[currentLanguage].home"></a>
            <a href="#" x-on:click="currentPage = 'about'; menuOpen = false" 
               :class="{ 'text-blue-500': currentPage === 'about' }" 
               x-text="translations[currentLanguage].about"></a>
            <a href="#" x-on:click="currentPage = 'contact'; menuOpen = false" 
               :class="{ 'text-blue-500': currentPage === 'contact' }" 
               x-text="translations[currentLanguage].contact"></a>
        </nav>
    </div>
</div>

