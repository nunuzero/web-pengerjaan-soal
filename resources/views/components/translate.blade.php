<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('translate', () => ({
            currentLanguage: localStorage.getItem('language') || 'id', // Bahasa default
            translations: {}, // Menyimpan terjemahan
            dropdownOpen: false, // Status dropdown

            // Toggle dropdown
            toggleDropdown() {
                this.dropdownOpen = !this.dropdownOpen;
            },

            // Mendapatkan teks status (ID atau EN dalam huruf besar)
            getStatusText() {
                return this.currentLanguage.toUpperCase(); // Ubah ke huruf besar
            },

            // Mendapatkan gambar bendera sesuai bahasa
            getFlagImage() {
                return this.currentLanguage === 'id'
                    ? '/assets/ID.png'
                    : '/assets/EN.png';
            },

            // Fungsi untuk memuat terjemahan berdasarkan bahasa yang dipilih
            async loadTranslations() {
                const response = await fetch(`/lang/${this.currentLanguage}/messages`);
                const data = await response.json();
                this.translations = data;
                this.updatePageText();
            },

            // Fungsi untuk memperbarui teks di halaman
            updatePageText() {
                document.querySelectorAll('[data-translate-key]').forEach(element => {
                    const key = element.getAttribute('data-translate-key');
                    element.textContent = this.translations[key] || key; // Ganti teks dengan terjemahan
                });
            },

            // Fungsi untuk mengganti bahasa
            async setLanguage(lang) {
                this.currentLanguage = lang;
                localStorage.setItem('language', lang);
                document.documentElement.setAttribute('lang', lang);

                // Memuat ulang terjemahan setelah bahasa diperbarui
                await this.loadTranslations();
            },

            // Inisialisasi saat komponen dimuat
            init() {
                this.loadTranslations();
            }
        }));
    });
</script>




<div x-data="translate()" class="relative">
    <!-- Button untuk membuka dropdown -->
    <button x-on:click="toggleDropdown" class="flex items-center space-x-2">
        <!-- Gambar bendera -->
        <img :src="getFlagImage()" alt="Flag" class="w-6 h-6">
        <!-- Tampilkan kode bahasa -->
        <span x-text="getStatusText()" class="font-medium"></span>
    </button>

    <!-- Dropdown Pilihan Bahasa -->
    <div x-show="dropdownOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:leave="transition ease-in duration-150"
         class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 shadow-lg rounded-md"
         style="display: none;">
        <!-- Pilihan Bahasa -->
        <button x-on:click="setLanguage('id'); toggleDropdown()" 
                class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700">
            <img src="/assets/ID.png" alt="ID Flag" class="inline-block w-4 h-4 mr-2"> ID
        </button>
        <button x-on:click="setLanguage('en'); toggleDropdown()" 
                class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700">
            <img src="/assets/EN.png" alt="EN Flag" class="inline-block w-4 h-4 mr-2"> EN
        </button>
    </div>
</div>
