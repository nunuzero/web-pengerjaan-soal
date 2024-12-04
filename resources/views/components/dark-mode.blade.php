<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('darkMode', () => ({
            darkMode: JSON.parse(localStorage.getItem('darkMode')) ?? window.matchMedia('(prefers-color-scheme: dark)').matches,

            // Toggle the dark mode on and off
            toggleDarkMode() {
                this.darkMode = !this.darkMode; // Toggle the dark mode value
                localStorage.setItem('darkMode', JSON.stringify(this.darkMode)); // Store in localStorage
                document.documentElement.classList.toggle('dark', this.darkMode); // Apply dark class to <html>
            },

            // Initialize dark mode state
            init() {
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }));
    });
</script>

<div x-data="darkMode" x-init="init()">
    <button x-on:click="toggleDarkMode" class="ml-4">
        <!-- Moon Icon (when dark mode is off) -->
        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m16.95-7.95l-1.414 1.414M6.464 17.536l-1.414 1.414M18.364 18.364l1.414-1.414M7.05 6.464L5.636 5.05" />
        </svg>

        <!-- Sun Icon (when dark mode is on) -->
        <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657A8 8 0 118.343 7.343m.707 12.02v.003M15.657 7.343m-3.72 9.274m0-14.004m0 14.004m0-14.004m0 14.004M9.807 11.195l5.196-5.196" />
        </svg>
    </button>
</div>
