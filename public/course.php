<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-gray-50 to-white min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gray-900 border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    <span class="text-2xl font-bold text-white">Youdemy</span>
                </a>

                <div class="flex items-center space-x-6">
                    <a href="course.php" class="text-white font-medium transition-colors">
                        Courses
                    </a>
                    <a href="login.php" class="text-gray-300 hover:text-white font-medium transition-colors">
                        Login
                    </a>
                    <a href="register.php" class="bg-white text-gray-900 px-6 py-3 rounded-full hover:bg-gray-100 transition-colors font-medium">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Browse Our Courses</h1>

            <!-- Barre de recherche -->
            <div class="mb-6">
                <div class="relative w-full max-w-md">
                    <input
                        type="text"
                        placeholder="Search courses..."
                        class="w-full px-4 py-2 rounded-full bg-gray-100 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors"
                    />
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Boutons de filtrage -->
            <div class="flex flex-wrap gap-4">
                <button class="px-4 py-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">All Courses</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">Development</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">Business</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">Design</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">Marketing</button>
            </div>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <img src="/api/placeholder/400/240" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Development</span>
                    <h3 class="text-xl font-semibold mt-4 mb-2">Complete Web Development Bootcamp</h3>
                    <p class="text-gray-600 mb-4">Learn web development from scratch with HTML, CSS, JavaScript, React, and Node.js</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-gray-900">$89.99</span>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">Enroll Now</button>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <img src="/api/placeholder/400/240" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Business</span>
                    <h3 class="text-xl font-semibold mt-4 mb-2">Business Management Fundamentals</h3>
                    <p class="text-gray-600 mb-4">Master the essentials of business management and leadership skills</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-gray-900">$69.99</span>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">Enroll Now</button>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <img src="/api/placeholder/400/240" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Design</span>
                    <h3 class="text-xl font-semibold mt-4 mb-2">UI/UX Design Masterclass</h3>
                    <p class="text-gray-600 mb-4">Create stunning user interfaces and improve user experience with modern design principles</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-gray-900">$79.99</span>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">Enroll Now</button>
                    </div>
                </div>
            </div>

            <!-- Course Card 4 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <img src="/api/placeholder/400/240" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Marketing</span>
                    <h3 class="text-xl font-semibold mt-4 mb-2">Digital Marketing Strategy</h3>
                    <p class="text-gray-600 mb-4">Learn to create and implement effective digital marketing campaigns</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-gray-900">$74.99</span>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">Enroll Now</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-24">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">About</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">Solutions</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">For Students</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">For Teachers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">For Business</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">For Schools</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Settings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Support</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Partners</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Feedback</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    <span class="text-xl font-bold text-white">Youdemy</span>
                </div>
                <p class="text-gray-500 text-sm">© 2024 Youdemy. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>