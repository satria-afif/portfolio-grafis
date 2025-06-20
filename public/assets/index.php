<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Desain Grafis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-light: #4f46e5;
            --primary-dark: #6366f1;
            --bg-light: #f9fafb;
            --bg-dark: #1f2937;
            --text-light: #111827;
            --text-dark: #f9fafb;
        }
        
        .dark {
            --primary: var(--primary-dark);
            --bg: var(--bg-dark);
            --text: var(--text-dark);
        }
        
        .light {
            --primary: var(--primary-light);
            --bg: var(--bg-light);
            --text: var(--text-light);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">GraphicPort</a>
            
            <nav class="hidden md:flex space-x-8">
                <a href="#home" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Home</a>
                <a href="#portfolio" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Portfolio</a>
                <a href="#about" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">About</a>
                <a href="#contact" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Contact</a>
            </nav>
            
            <div class="flex items-center space-x-4">
                <button id="theme-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
                
                <a href="/admin/login.php" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Admin</a>
                
                <button class="md:hidden p-2" id="mobile-menu-button">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white dark:bg-gray-800 shadow-lg" id="mobile-menu">
            <div class="container mx-auto px-4 py-2 flex flex-col space-y-2">
                <a href="#home" class="py-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Home</a>
                <a href="#portfolio" class="py-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Portfolio</a>
                <a href="#about" class="py-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition">About</a>
                <a href="#contact" class="py-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Contact</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Hi, I'm <span class="text-indigo-600 dark:text-indigo-400">Graphic Designer</span></h1>
                <p class="text-lg mb-6">Creating impactful visual identities through thoughtful design solutions.</p>
                <div class="flex space-x-4">
                    <a href="#portfolio" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">View Portfolio</a>
                    <a href="#contact" class="px-6 py-3 border border-indigo-600 text-indigo-600 dark:text-indigo-400 rounded-md hover:bg-indigo-50 dark:hover:bg-gray-700 transition">Contact Me</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden border-4 border-indigo-600 dark:border-indigo-400 shadow-xl">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" alt="Designer" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">My Portfolio</h2>
            
            <!-- Filter Buttons -->
            <div class="flex justify-center mb-8 space-x-4">
                <button class="filter-btn px-4 py-2 rounded-md bg-indigo-600 text-white" data-filter="all">All</button>
                <button class="filter-btn px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600" data-filter="logo">Logo</button>
                <button class="filter-btn px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600" data-filter="poster">Poster</button>
                <button class="filter-btn px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600" data-filter="banner">Banner</button>
            </div>
            
            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
                <!-- Items will be loaded via JavaScript -->
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">About Me</h2>
            
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/3 mb-8 md:mb-0 flex justify-center">
                    <div class="w-64 h-64 rounded-full overflow-hidden border-4 border-indigo-600 dark:border-indigo-400 shadow-lg">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" alt="Designer" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <div class="md:w-2/3 md:pl-12">
                    <h3 class="text-2xl font-semibold mb-4">Professional Graphic Designer</h3>
                    <p class="mb-4">With over 5 years of experience in the design industry, I specialize in creating visually compelling brand identities, marketing materials, and digital assets that communicate effectively and resonate with target audiences.</p>
                    <p class="mb-6">My approach combines strategic thinking with creative execution to deliver designs that are not only aesthetically pleasing but also serve their intended purpose.</p>
                    
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-3">Skills</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">Logo Design</span>
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">Brand Identity</span>
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">Typography</span>
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">Illustration</span>
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">Print Design</span>
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">Digital Design</span>
                        </div>
                    </div>
                    
                    <a href="#" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Download CV</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Get In Touch</h2>
            
            <div class="max-w-3xl mx-auto">
                <form id="contact-form" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-2">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="subject" class="block mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="message" class="block mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>
                    
                    <div class="md:col-span-2">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <a href="#" class="text-2xl font-bold text-indigo-400">GraphicPort</a>
                    <p class="mt-2">Creating impactful designs for your brand.</p>
                </div>
                
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-behance text-xl"></i></a>
                    <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-dribbble text-xl"></i></a>
                    <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-linkedin text-xl"></i></a>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 GraphicPort. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="/public/assets/js/theme.js"></script>
    <script src="/public/assets/js/portfolio.js"></script>
    <script src="/public/assets/js/contact.js"></script>
    <script src="/public/assets/js/mobile-menu.js"></script>
</body>
</html>
