<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('translate', () => ({
            currentLanguage: localStorage.getItem('language') || 'id',
            translations: {
                en: {
                    home: 'Home',
                    about: 'About',
                    contact: 'Contact',
                    homeTitle: 'Welcome to the Home page!',
                    homeDescription: 'This is the Home page. Learn about us here.',
                    aboutTitle: 'Learn more about us',
                    aboutDescription: 'We are a team of passionate individuals working together.',
                    contactTitle: 'Contact Us',
                    contactDescription: 'Contact us through this page for more information.',
                },
                id: {
                    home: 'Beranda',
                    about: 'Tentang',
                    contact: 'Kontak',
                    homeTitle: 'Selamat datang di halaman Beranda!',
                    homeDescription: 'Ini adalah halaman Beranda. Pelajari lebih lanjut tentang kami di sini.',
                    aboutTitle: 'Pelajari lebih lanjut tentang kami',
                    aboutDescription: 'Kami adalah tim individu yang penuh semangat yang bekerja bersama.',
                    contactTitle: 'Hubungi Kami',
                    contactDescription: 'Hubungi kami melalui halaman ini untuk informasi lebih lanjut.',
                }
            },
            translateMenuOpen: false,
            setLanguage(lang) {
                this.currentLanguage = lang;
                localStorage.setItem('language', lang);  // Store selected language
                document.documentElement.setAttribute('lang', lang);  // Change HTML lang attribute
                this.translateMenuOpen = false; // Close the dropdown menu
                this.updatePageText();  // Update the text dynamically on the page
                this.$dispatch('language-changed', lang);  // Dispatch the language-changed event
            },
            toggleTranslateMenu() {
                this.translateMenuOpen = !this.translateMenuOpen;
            },
            updatePageText() {
                // Dynamically update the text for elements with data-translate-key
                document.querySelectorAll('[data-translate-key]').forEach((element) => {
                    const key = element.getAttribute('data-translate-key');
                    element.textContent = this.translations[this.currentLanguage][key];
                });
            }
        }));
    });
</script>

<div x-data="translate" class="relative">
    <button x-on:click="toggleTranslateMenu" class="flex items-center space-x-2">
        <img :src="currentLanguage === 'id' ? '/flags/id.png' : '/flags/en.png'" alt="flag" class="w-6 h-6">
        <span x-text="currentLanguage === 'id' ? 'ID' : 'EN'" class="font-bold"></span>
    </button>
    <!-- Dropdown -->
    <div x-show="translateMenuOpen" 
         x-on:click.away="translateMenuOpen = false"
         class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 shadow-md rounded-md p-2">
        <button x-on:click="setLanguage('id')" class="flex items-center w-full px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">
            <img src="/flags/id.png" alt="Indonesia" class="w-5 h-5 mr-2"> Indonesia
        </button>
        <button x-on:click="setLanguage('en')" class="flex items-center w-full px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">
            <img src="/flags/en.png" alt="English" class="w-5 h-5 mr-2"> English
        </button>
    </div>
</div>

