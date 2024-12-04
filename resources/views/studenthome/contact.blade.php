<div x-data="{ currentSlide: 0 }" class="relative dark:bg-gray-800 bg-white transition-all duration-500 mt-8">
  <!-- Slide Navigation -->
  <div class="absolute top-0 left-0 w-full flex justify-center gap-4 p-4 z-10">
    <button @click="currentSlide = 0" :class="currentSlide === 0 ? 'text-blue-500' : 'text-gray-500'" class="text-xl font-semibold transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
      <span data-translate-key="nunuZero">NunuZero</span>
    </button>
    <button @click="currentSlide = 1" :class="currentSlide === 1 ? 'text-blue-500' : 'text-gray-500'" class="text-xl font-semibold transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
      <span data-translate-key="ilumi">Ilumi</span>
    </button>
  </div>

  <!-- Slide Content -->
  <div class="relative">
    <!-- NunuZero Slide -->
    <div :class="currentSlide === 0 ? 'opacity-100' : 'opacity-0'" class="transition-opacity duration-500 ease-in-out absolute inset-0 p-8 text-center space-y-6">
      <h2 class="text-4xl font-bold text-gray-800 dark:text-white mt-6" data-translate-key="nunuZeroTitle">Contact NunuZero</h2>
      <p class="text-lg text-gray-600 dark:text-gray-400" data-translate-key="nunuZeroDescription">Get in touch with NunuZero for collaboration or inquiries.</p>
      
      <!-- Profile Image & Voyager Info -->
      <div class="flex justify-center items-center space-x-4">
        <img src="/assets/3.jpg" alt="NunuZero Profile" class="rounded-full w-24 h-24 object-cover border-2 border-gray-400 dark:border-gray-600">
        <div class="text-left">
          <p class="text-xl font-semibold text-gray-800 dark:text-white">Voyager #1</p>
        </div>
      </div>

      <div class="flex justify-center space-x-6 mt-6">
        <a href="https://instagram.com/nunuzero" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors" aria-label="Instagram">
          <i class="fab fa-instagram text-2xl"></i>
        </a>
        <a href="https://github.com/nunuzero" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors" aria-label="GitHub">
          <i class="fab fa-github text-2xl"></i>
        </a>
        <a href="https://linkedin.com/in/nunuzero" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors" aria-label="LinkedIn">
          <i class="fab fa-linkedin text-2xl"></i>
        </a>
      </div>
    </div>

    <!-- Ilumi Slide -->
    <div :class="currentSlide === 1 ? 'opacity-100' : 'opacity-0'" class="transition-opacity duration-500 ease-in-out absolute inset-0 p-8 text-center space-y-6">
      <h2 class="text-4xl font-bold text-gray-800 dark:text-white mt-6" data-translate-key="ilumiTitle">Contact Ilumi</h2>
      <p class="text-lg text-gray-600 dark:text-gray-400" data-translate-key="ilumiDescription">Reach out to Ilumi for projects or support.</p>

      <!-- Profile Image & Voyager Info -->
      <div class="flex justify-center items-center space-x-4">
        <img src="/assets/5.png" alt="Ilumi Profile" class="rounded-full w-24 h-24 object-cover border-2 border-gray-400 dark:border-gray-600">
        <div class="text-left">
          <p class="text-xl font-semibold text-gray-800 dark:text-white">Voyager #2</p>
        </div>
      </div>

      <div class="flex justify-center space-x-6 mt-6">
        <a href="https://instagram.com/ilumi" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors" aria-label="Instagram">
          <i class="fab fa-instagram text-2xl"></i>
        </a>
        <a href="https://github.com/ilumi" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors" aria-label="GitHub">
          <i class="fab fa-github text-2xl"></i>
        </a>
        <a href="https://linkedin.com/in/ilumi" class="text-gray-600 dark:text-gray-400 hover:text-blue-500 transition-colors" aria-label="LinkedIn">
          <i class="fab fa-linkedin text-2xl"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Tailwind CSS for Dark Mode & Transitions -->
<style>
  /* Font Awesome Icons */
  @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
</style>
