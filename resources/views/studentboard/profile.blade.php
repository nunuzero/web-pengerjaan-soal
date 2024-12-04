<div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-800 transition-all mt-10">
        <div class="max-w-7xl mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Profile Section -->
                <div class="text-center">
                    <div class="relative inline-block mb-6">
                        <!-- Profile Icon -->
                        <img id="profile-icon" 
                             src="{{ asset('images/profile-icon.png') }}" 
                             alt="Profile Icon" 
                             class="w-24 h-24 rounded-full mx-auto mb-4">

                        <!-- Edit Button -->
                        <button @click="$refs.fileInput.click()" 
                                class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-3 3m0 0l-3-3m3 3V6m-6 7l-3 3m0 0l-3-3m3 3V6" />
                            </svg>
                        </button>
                        <!-- File Input for Changing Profile Icon -->
                        <input type="file" x-ref="fileInput" class="hidden" @change="changeProfilePhoto">
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white" data-translate-key="student_name">Student Name</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300" data-translate-key="student_id">12345678</p>
                </div>

                <!-- Profile Details -->
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300" data-translate-key="name_label">Name</label>
                        <input type="text" id="name" value="Jokowi Kun" class="w-full p-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="space-y-2">
                        <label for="student_id" class="text-sm font-medium text-gray-700 dark:text-gray-300" data-translate-key="student_number_label">Student Number</label>
                        <input type="text" id="student_id" value="12345678" class="w-full p-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:text-white" disabled>
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium text-gray-700 dark:text-gray-300" data-translate-key="change_password">Change Password</label>
                        <input type="password" id="password" class="w-full p-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:text-white" placeholder="Enter new password">
                    </div>

                    <button class="w-full bg-blue-500 text-white p-2 rounded-md" data-translate-key="save_changes">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to change and synchronize profile photo
        function changeProfilePhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    const newPhoto = reader.result;
                    document.getElementById('profile-icon').src = newPhoto;

                    // Save photo URL to localStorage
                    localStorage.setItem('profilePhoto', newPhoto);

                    // Update profile icon on other pages
                    const otherIcons = document.querySelectorAll('.global-profile-icon');
                    otherIcons.forEach(icon => {
                        icon.src = newPhoto;
                    });
                };
                reader.readAsDataURL(file);
            }
        }

        // Load photo from localStorage on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedPhoto = localStorage.getItem('profilePhoto');
            if (savedPhoto) {
                document.getElementById('profile-icon').src = savedPhoto;
            }
        });
    </script>
</div>
