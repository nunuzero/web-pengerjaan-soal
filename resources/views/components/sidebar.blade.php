<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebar', () => ({
            menuOpen: false,
            currentPage: 'home',
            toggleMenu() {
                this.menuOpen = !this.menuOpen;
            },
            setPage(page) {
                this.currentPage = page;
                this.menuOpen = false;
            },
        }));
    });
</script>

<!-- Sidebar for Mobile -->
<div x-show="menuOpen" 
     x-transition:enter="transition ease-out duration-200" 
     x-transition:leave="transition ease-in duration-150"
     class="fixed inset-0 bg-gray-800 bg-opacity-75 lg:hidden z-50" 
     aria-labelledby="mobile-menu"
     role="dialog"
     aria-modal="true">
    <div class="absolute top-0 left-0 w-64 h-full bg-white dark:bg-gray-900 shadow-md p-4 z-60"> <!-- Added z-60 to make sure sidebar is on top -->
        <!-- Close Button -->
        <button x-on:click="menuOpen = false" class="text-gray-800 dark:text-gray-200" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Navigation Links -->
        <nav class="mt-4 space-y-4">
            @foreach (['home' => __('messages.home'), 'about' => __('messages.about'), 'contact' => __('messages.contact')] as $key => $label)
                <a href="#"
                   x-on:click="setPage('{{ $key }}')" 
                   :class="{ 'text-blue-500': currentPage === '{{ $key }}' }" 
                   class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800"
                   aria-label="{{ $label }}"
                   data-translate-key="{{ $key }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

    </div>
</div>
