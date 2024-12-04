<div x-data="{
        showModal: false, 
        studentNumber: '', 
        password: '', 
        login() {
            // Hardcoded credentials for demo purposes
            const correctStudentNumber = '12345678';
            const correctPassword = '87654321';

            // Validate student number and password
            if (this.studentNumber === correctStudentNumber && this.password === correctPassword) {
                // Redirect to navboard if credentials are correct
                window.location.href = '/navboard';
            } else {
                alert('Invalid credentials!');
            }
        }
    }" 
    class="fixed inset-0 flex flex-col items-center justify-center bg-blue-500 dark:bg-gray-900 overflow-hidden">

    <link rel="preload" href="/assets/makoto.json" as="fetch" type="application/json" crossorigin="anonymous">
    <link rel="prefetch" href="/assets/makoto.json" as="fetch" type="application/json" crossorigin="anonymous">
    <!-- Lottie Animation -->
    <lottie-player 
        class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 overflow-hidden"
        src="/assets/makoto.json"  
        background="transparent"  
        speed="1"  
        loop  
        autoplay  
        lazy="true"
        style="transform: scale(1.2);"
        x-show="window.innerWidth >= 768"
    ></lottie-player>

    <!-- Page Content -->
    <div class="text-center text-white z-10 relative">
        <h2 data-translate-key="homeTitle" class="text-4xl font-bold drop-shadow-lg">{{ __('messages.homeTitle') }}</h2>
        <p data-translate-key="homeDescription" class="mt-4 text-lg drop-shadow-md">{{ __('messages.homeDescription') }}</p>
    </div>

    <!-- Login Button -->
    <button 
        x-on:click="showModal = true" 
        class="fixed bottom-8 left-1/2 transform -translate-x-1/2 md:bottom-16 md:right-8 md:left-auto lg:right-16 bg-blue-600 dark:bg-indigo-700 text-white py-4 px-8 rounded-full shadow-lg hover:bg-blue-700 dark:hover:bg-indigo-800 transition-transform transform hover:scale-105 text-lg z-20"
        data-translate-key="loginButton">
        {{ __('messages.loginButton') }}
    </button>

    <!-- Login Modal -->
    <div 
        x-show="showModal" 
        x-on:keydown.escape.window="showModal = false" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50"
    >
        <!-- Modal Content -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full relative">
            <!-- Close Button -->
            <button 
                x-on:click="showModal = false" 
                class="absolute top-3 right-3 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Title -->
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4" data-translate-key="loginTitle">{{ __('messages.loginTitle') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6" data-translate-key="loginDescription">{{ __('messages.loginDescription') }}</p>

            <!-- Login Form -->
            <form @submit.prevent="login">
                <!-- Student Number -->
                <div class="mb-4">
                    <label for="studentNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-300" data-translate-key="studentNumber">{{ __('messages.studentNumber') }}</label>
                    <input 
                        type="text" 
                        id="studentNumber" 
                        x-model="studentNumber"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" >
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300" data-translate-key="password">{{ __('messages.password') }}</label>
                    <input 
                        type="password" 
                        id="password" 
                        x-model="password"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" >
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 dark:bg-indigo-700 text-white py-2 px-4 rounded-md hover:bg-blue-700 dark:hover:bg-indigo-800 transition" 
                    data-translate-key="loginButton"
                >
                    {{ __('messages.loginButton') }}
                </button>
            </form>
        </div>
        <!-- Decorative Images -->
    <img 
        src="/assets/yanagi.png" 
        alt="Desktop Decorative" 
        class="absolute bottom-4 right-4 w-60 h-60 z-10 hidden md:block"
    >
    </div>
</div>

