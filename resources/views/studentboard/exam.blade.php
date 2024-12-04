<!DOCTYPE html>
<html lang="id" x-data="examPage" x-init="initExam">
@include('components.head')

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white h-screen">
    <!-- Header -->
    <header class="p-4 bg-gray-200 dark:bg-gray-800 shadow-md fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Title -->
            <div>
                <h1 class="text-lg font-bold" x-text="translateKey('examTitle')"></h1>
                <p class="text-sm" x-text="translateKey('examSubtitle')"></p>
            </div>

            <!-- Profile Dropdown, Timer -->
            <div class="relative flex items-center space-x-4">
                <!-- Timer -->
                <div>
                    <span class="text-xl font-mono" x-text="formattedTime"></span>
                </div>

                <!-- Profile Dropdown -->
                <div @click.away="showDropdown = false" class="relative">
                    <button @click="showDropdown = !showDropdown" class="relative h-10 w-10 rounded-full focus:outline-none transition-transform transform hover:scale-105 active:scale-95 overflow-hidden shadow-lg">
                        <img 
                            src="{{ asset('images/profile-icon.png') }}" 
                            alt="User Avatar" 
                            class="absolute inset-0 w-full h-full object-cover rounded-full">
                    </button>
                    <div x-show="showDropdown" x-transition 
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            <li>
                                @include('components.dark-mode')
                            </li>
                            <li>
                                @include('components.translate')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-4 pt-24 grid grid-cols-1 lg:grid-cols-5 gap-4">
        <!-- Left Content (Questions) -->
        <div class="lg:col-span-3 space-y-6 overflow-y-auto max-h-[calc(100vh-7rem)]">
            <!-- Question Content -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-4 w-full">
                <h3 class="font-bold text-center">Question <span x-text="currentQuestion + 1"></span>:</h3>
                <p x-text="currentQuestionText" class="text-center"></p>
                <div>
                    <template x-for="(option, index) in currentQuestionOptions" :key="index">
                        <label class="block transition hover:bg-gray-200 dark:hover:bg-gray-600 p-2 rounded">
                            <input type="radio" 
                                   :value="option" 
                                   :name="'question-' + currentQuestion" 
                                   x-model="answers[currentQuestion]" 
                                   class="mr-2">
                            <span x-text="option"></span>
                        </label>
                    </template>
                </div>
            </div>

            <!-- Navigation Buttons (Previous/Next) -->
            <div class="flex justify-between items-center space-x-4 mt-4">
                <button @click="prevQuestion" 
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg transition hover:bg-gray-400 dark:hover:bg-gray-600">
                    Previous
                </button>

                <!-- Sidebar Button for Mobile -->
                <button @click="toggleSidebar" 
                        class="lg:hidden px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg transition hover:bg-gray-400 dark:hover:bg-gray-600">
                    Menu
                </button>

                <button @click="nextQuestion" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg transition hover:bg-blue-600">
                    Next
                </button>
            </div>
        </div>

        <!-- Right Content (Pagination) -->
        <div class="lg:col-span-2 space-y-4 hidden lg:block">
            <!-- Pagination Navigation for Desktop -->
            <div class="grid grid-cols-5 gap-2">
                <template x-for="(question, index) in paginatedQuestions[currentPage]" :key="index">
                    <button @click="currentQuestion = currentPage * 30 + index" 
                            :class="{
                                'bg-red-500 text-white': currentQuestion === currentPage * 30 + index, 
                                'bg-blue-500 text-white': currentQuestion !== currentPage * 30 + index,
                                'bg-green-500': answers[currentPage * 30 + index],
                                'bg-gray-300 dark:bg-gray-700': !answers[currentPage * 30 + index]
                            }"
                            class="w-full p-2 rounded transition hover:bg-gray-400 dark:hover:bg-gray-600">
                        <span x-text="currentPage * 30 + index + 1"></span>
                    </button>
                </template>
            </div>

            <!-- Right Pagination Controls -->
            <div class="flex justify-between mt-4">
                <button @click="prevPage" 
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg">
                    Prev Page
                </button>
                <button @click="nextPage" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                    Next Page
                </button>
            </div>

            <!-- Finish Exam Button -->
            <button @click="openModal" 
                    class="w-full px-4 py-2 bg-green-500 text-white rounded-lg transition hover:bg-green-600">
                Finish Exam
            </button>
        </div>

        <!-- Sidebar (Mobile) -->
        <div x-show="showSidebar" 
             class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" @click.away="showSidebar = false">
            <div class="bg-white dark:bg-gray-800 w-64 h-full p-4 space-y-4">
                <button @click="toggleSidebar" class="mb-4 px-4 py-2 bg-red-500 text-white rounded-lg">Close</button>
                <div class="grid grid-cols-5 gap-2">
                    <template x-for="(question, index) in paginatedQuestions[currentPage]" :key="index">
                        <button @click="currentQuestion = currentPage * 30 + index; showSidebar = false" 
                                :class="{
                                    'bg-red-500 text-white': currentQuestion === currentPage * 30 + index, 
                                    'bg-blue-500 text-white': currentQuestion !== currentPage * 30 + index,
                                    'bg-green-500': answers[currentPage * 30 + index],
                                    'bg-gray-300 dark:bg-gray-700': !answers[currentPage * 30 + index]
                                }"
                                class="p-2 rounded transition hover:bg-gray-400 dark:hover:bg-gray-600">
                            <span x-text="currentPage * 30 + index + 1"></span>
                        </button>
                    </template>
                </div>
                <!-- Pagination for Sidebar -->
                <div class="flex justify-between mt-4">
                    <button @click="prevPage" 
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg">
                        Prev
                    </button>
                    <button @click="nextPage" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                        Next
                    </button>
                </div>
                <!-- Finish Exam Button for Mobile -->
                <button @click="openModal" 
                        class="w-full px-4 py-2 bg-green-500 text-white rounded-lg transition hover:bg-green-600">
                    Finish Exam
                </button>
            </div>
        </div>
    </div>

    <!-- Modal for Confirm Finish Exam -->
    <div x-show="showModal" 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg space-y-4">
            <h2 class="text-lg font-bold" x-text="translateKey('finishExamPrompt')"></h2>
            <div class="flex justify-end space-x-4">
                <button @click="closeModal" 
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg">
                    Cancel
                </button>
                <button @click="submitExam" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg transition hover:bg-red-600">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('examPage', () => ({
                currentPage: 0,
                currentQuestion: 0,
                timeRemaining: 3600,
                showDropdown: false,
                showModal: false,
                showSidebar: false,
                questions: Array.from({ length: 150 }, (_, i) => ({
                    question: `Question ${i + 1}?`,
                    options: ['Option A', 'Option B', 'Option C', 'Option D']
                })),
                answers: Array(150).fill(null),
                translations: {
                    en: {
                        examTitle: 'Math Exam',
                        examSubtitle: 'Chapter 1-5',
                        finishExamPrompt: 'Are you sure you want to finish the exam?',
                    },
                    id: {
                        examTitle: 'Ujian Matematika',
                        examSubtitle: 'Bab 1-5',
                        finishExamPrompt: 'Apakah Anda yakin ingin mengakhiri ujian?',
                    },
                },
                lang: 'en',

                get paginatedQuestions() {
                    const chunkSize = 30;
                    return Array.from({ length: Math.ceil(this.questions.length / chunkSize) }, (_, i) =>
                        this.questions.slice(i * chunkSize, i * chunkSize + chunkSize)
                    );
                },

                get currentQuestionText() {
                    return this.questions[this.currentQuestion].question;
                },

                get currentQuestionOptions() {
                    return this.questions[this.currentQuestion].options;
                },

                initExam() {
                    const savedState = localStorage.getItem('examState');
                    if (savedState) {
                        const state = JSON.parse(savedState);
                        this.currentPage = state.currentPage || 0;
                        this.currentQuestion = state.currentQuestion || 0;
                        this.timeRemaining = state.timeRemaining || 3600;
                        this.answers = state.answers || Array(150).fill(null);
                        this.lang = state.lang || 'en';
                    }
                    this.countdown();
                },

                countdown() {
                    if (this.timeRemaining > 0) {
                        this.timeRemaining--;
                        setTimeout(this.countdown.bind(this), 1000);
                        this.saveState(); 
                    } else {
                        this.submitExam();
                    }
                },

                saveState() {
                    const state = {
                        currentPage: this.currentPage,
                        currentQuestion: this.currentQuestion,
                        timeRemaining: this.timeRemaining,
                        answers: this.answers,
                        lang: this.lang
                    };
                    localStorage.setItem('examState', JSON.stringify(state));
                },

                formattedTime() {
                    const minutes = Math.floor(this.timeRemaining / 60);
                    const seconds = this.timeRemaining % 60;
                    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                },

                prevPage() {
                    if (this.currentPage > 0) {
                        this.currentPage--;
                        this.saveState();
                    }
                },

                nextPage() {
                    if (this.currentPage < this.paginatedQuestions.length - 1) {
                        this.currentPage++;
                        this.saveState();
                    }
                },

                prevQuestion() {
                    if (this.currentQuestion > 0) {
                        this.currentQuestion--;
                        this.saveState();
                    }
                },

                nextQuestion() {
                    if (this.currentQuestion < this.questions.length - 1) {
                        this.currentQuestion++;
                        this.saveState();
                    }
                },

                translateKey(key) {
                    return this.translations[this.lang][key] || key;
                },

                openModal() {
                    this.showModal = true;
                },

                closeModal() {
                    this.showModal = false;
                },

                submitExam() {
                    alert('Exam Submitted!');
                    window.location.href = '/navboard';
                },

                toggleSidebar() {
                    this.showSidebar = !this.showSidebar;
                    this.saveState();
                },
                
            }));
        });
    </script>
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
</body>
</html>
