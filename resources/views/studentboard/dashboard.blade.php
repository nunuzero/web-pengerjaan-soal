<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white h-screen">
  <div class="h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="dashboard">
    <!-- Search Bar -->
    <div class="mb-6">
      <input 
        type="text" 
        placeholder="Search exams..." 
        class="w-full p-4 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white"
        data-translate-key="search_placeholder"
        x-model="searchQuery"
        @input="filterExams"
      />
    </div>

    <!-- Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 h-[calc(100%-120px)]">
      <!-- Ongoing Exams -->
      <div class="flex flex-col h-full">
        <h2 class="text-xl font-semibold mb-4" data-translate-key="ongoing_exams">Ongoing Exams</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-grow">
          <!-- Cards -->
          <template x-for="exam in filteredOngoingExams" :key="exam.id">
            <button 
              class="p-4 rounded-lg shadow-md bg-white dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-900 transition-all duration-200 transform hover:scale-105 active:scale-95"
              @click="openModal('ongoing', exam.id)"
            >
              <h3 class="text-lg font-bold" x-text="exam.subject"></h3>
              <p class="text-sm" x-text="exam.subtitle"></p>
              <p class="text-sm mt-2">
                <span data-translate-key="start_at">Start:</span> <span x-text="exam.start"></span><br>
                <span data-translate-key="end_at">End:</span> <span x-text="exam.end"></span>
              </p>
            </button>
          </template>
        </div>
        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-4">
          <button 
            @click="prevPage('ongoing')" 
            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg"
            data-translate-key="prev_button"
          >
            Previous
          </button>
          <button 
            @click="nextPage('ongoing')" 
            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg"
            data-translate-key="next_button"
          >
            Next
          </button>
        </div>
      </div>

      <!-- Upcoming Exams -->
      <div class="flex flex-col h-full">
        <h2 class="text-xl font-semibold mb-4" data-translate-key="upcoming_exams">Upcoming Exams</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-grow">
          <!-- Cards -->
          <template x-for="exam in filteredUpcomingExams" :key="exam.id">
            <button 
              class="p-4 rounded-lg shadow-md bg-white dark:bg-gray-800 hover:bg-green-100 dark:hover:bg-green-900 transition-all duration-200 transform hover:scale-105 active:scale-95"
              @click="openModal('upcoming', exam.id)"
            >
              <h3 class="text-lg font-bold" x-text="exam.subject"></h3>
              <p class="text-sm" x-text="exam.subtitle"></p>
              <p class="text-sm mt-2">
                <span data-translate-key="start_at">Start:</span> <span x-text="exam.start"></span><br>
                <span data-translate-key="end_at">End:</span> <span x-text="exam.end"></span>
              </p>
            </button>
          </template>
        </div>
        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-4">
          <button 
            @click="prevPage('upcoming')" 
            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg"
            data-translate-key="prev_button"
          >
            Previous
          </button>
          <button 
            @click="nextPage('upcoming')" 
            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg"
            data-translate-key="next_button"
          >
            Next
          </button>
        </div>
      </div>
    </div>

   
     <!-- Modal for Ongoing Exams -->
    <div 
        x-show="modalOpen && modalType === 'ongoing'" 
        x-cloak 
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg">
            <h3 class="text-lg font-bold" data-translate-key="modal_title_ongoing" x-text="modalMessage"></h3>
            <div class="mt-4">
            <button 
                @click="startExam" 
                class="px-4 py-2 bg-green-500 text-white rounded-lg"
                data-translate-key="confirm_start_exam" >
                Yes, Start
             </button>
              <button 
                @click="closeModal" 
               class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg"
                data-translate-key="close_modal">
                Close
              </button>
            </div>
        </div>
        <img 
        src="/assets/yanagi.png" 
        alt="Desktop Decorative" 
        class="absolute bottom-4 right-4 w-60 h-60 z-10 hidden md:block" >
    </div>

    <!-- Modal for Upcoming Exams -->
    <div 
        x-show="modalOpen && modalType === 'upcoming'" 
        x-cloak 
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg">
          <h3 class="text-lg font-bold" data-translate-key="modal_title_upcoming" x-text="modalMessage"></h3>
           <div class="mt-4">
           <button 
            @click="closeModal" 
            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg"
            data-translate-key="close_modal">
            Close
           </button>
           </div>
        </div>
        <img 
        src="/assets/miyabi.png" 
        alt="Desktop Decorative" 
        class="absolute bottom-4 right-4 w-60 h-60 z-10 hidden md:block">
    </div>
    </div>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('dashboard', () => ({
        searchQuery: '',
        ongoingExams: Array.from({ length: 20 }, (_, i) => ({
          id: i + 1,
          subject: `Ongoing Exam ${i + 1}`,
          subtitle: `Subtitle for Exam ${i + 1}`,
          start: `10:00 AM`,
          end: `11:00 AM`,
        })),
        upcomingExams: Array.from({ length: 20 }, (_, i) => ({
          id: i + 21,
          subject: `Upcoming Exam ${i + 21}`,
          subtitle: `Subtitle for Exam ${i + 21}`,
          start: `12:00 PM`,
          end: `1:00 PM`,
        })),
        currentPage: { ongoing: 1, upcoming: 1 },
        itemsPerPage: 4,
        modalOpen: false,
        modalType: '',
        modalTitleKey: '',
        modalMessage: '',

        get filteredOngoingExams() {
          return this.paginate(
            this.ongoingExams.filter(exam => 
              exam.subject.toLowerCase().includes(this.searchQuery.toLowerCase())
            ),
            this.currentPage.ongoing
          );
        },
        get filteredUpcomingExams() {
          return this.paginate(
            this.upcomingExams.filter(exam => 
              exam.subject.toLowerCase().includes(this.searchQuery.toLowerCase())
            ),
            this.currentPage.upcoming
          );
        },

        paginate(items, page) {
          const start = (page - 1) * this.itemsPerPage;
          return items.slice(start, start + this.itemsPerPage);
        },
        nextPage(type) {
          this.currentPage[type]++;
        },
        prevPage(type) {
          if (this.currentPage[type] > 1) this.currentPage[type]--;
        },

   
        openModal(type, id) {
          this.modalType = type;
          if (type === 'ongoing') {
          this.modalTitleKey = 'modal_title_ongoing'; // Set title for ongoing exams
          } else if (type === 'upcoming') {
          this.modalTitleKey = 'modal_title_upcoming'; // Set title for upcoming exams
          }
           this.modalOpen = true;
        },


        closeModal() {
          this.modalOpen = false;
        },
        startExam() {
          window.location.href = '/exam';
        },
      }));
    });
  </script>
</body>
