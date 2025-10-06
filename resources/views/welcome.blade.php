<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JNEC IT Asset Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Custom styles for the modal */
            .registration-success-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.6);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
                visibility: hidden; /* Hidden by default */
                opacity: 0;
                transition: visibility 0s, opacity 0.3s linear;
            }
            .registration-success-modal.show {
                visibility: visible;
                opacity: 1;
            }
            .registration-success-modal-content {
                background-color: white;
                padding: 2.5rem; /* p-10 */
                border-radius: 0.5rem; /* rounded-lg */
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-xl */
                text-align: center;
                max-width: 28rem; /* sm:max-w-md, a bit more flexible */
                width: 90%;
            }
            .registration-success-modal-content h3 {
                font-size: 1.5rem; /* text-2xl */
                font-weight: 700; /* font-bold */
                color: #10B981; /* text-green-600 */
                margin-bottom: 1rem; /* mb-4 */
            }
            .registration-success-modal-content p {
                color: #4B5563; /* text-gray-700 */
                margin-bottom: 1.5rem; /* mb-6 */
            }
            .registration-success-modal-content .login-btn {
                display: inline-block;
                background-color: #4F46E5; /* bg-indigo-600 */
                color: white;
                font-weight: 700; /* font-bold */
                padding: 0.5rem 1rem; /* py-2 px-4 */
                border-radius: 0.375rem; /* rounded-md */
                transition: background-color 0.15s ease-in-out;
            }
            .registration-success-modal-content .login-btn:hover {
                background-color: #4338CA; /* hover:bg-indigo-700 */
            }
            /* Adjust Navbar Register/Login to pass email if session exists */
            .navbar-login-link {
                /* Tailwind's classes are fine for this, just ensure the link gets updated */
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm fixed w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo/Title -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-2xl font-bold text-gray-800">JNEC IT Asset Management</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="#about" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">About Us</a>
                        <a href="#mission-vision" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Our Mission and Vision</a>
                        <a href="#services" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Services</a>
                        <a href="#system-overview" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">System Overview</a>
                        
                        @if (Route::has('login'))
                            <div class="ml-4 flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                                @else
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:border-emerald-900 focus:ring ring-emerald-300 disabled:opacity-25 transition ease-in-out duration-150">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <!-- Custom Success Modal for Registration -->
            <div id="registrationSuccessModal" class="registration-success-modal">
                <div class="registration-success-modal-content">
                    <h3 id="modalMessage">Registration successful!</h3>
                    <p>Please log in with your new account.</p>
                    <a id="modalLoginButton" href="{{ route('login') }}" class="login-btn">
                        Go to Login
                    </a>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="relative bg-cover bg-center h-screen flex items-center justify-center text-white" style="background-image: url('{{ asset('image/welcom.ditjnec.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="relative z-10 text-center max-w-4xl px-4">
                    <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-4 animate-fade-in-up">WELCOME TO JNEC IT ASSET MANAGEMENT PORTAL</h1>
                    <p class="text-xl md:text-2xl font-light mb-8 animate-fade-in-up delay-200">Your centralized solution for managing IT resources efficiently.</p>
                    {{-- This "Get Started" button will always lead to the login page --}}
                    <a href="{{ route('login') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg text-lg animate-fade-in-up delay-400">Get Started</a>
                </div>
            </div>

            <!-- Streamline Section -->
            <section class="py-16 bg-gray-50" id="streamline">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="md:order-1">
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-6">Streamline Your IT Asset Management</h2>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The JNEC IT Asset Management Portal provides an efficient and transparent way to manage and track all IT equipment across the college. 
                            From deployment to disposal, monitor asset status, user assignments, and maintenance history in one place. 
                            Reduce manual tracking and save time with our easy-to-use online system.
                        </p>
                        {{-- This button will also take to the login page --}}
                        <a href="{{ route('login') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-md shadow-md text-base">Learn More</a>
                    </div>
                    <div class="md:order-2 flex justify-center">
                        {{-- Replace this with an actual IT asset management image if desired --}}
                        <img src="https://via.placeholder.com/500x300/F3F4F6/1F2937?text=IT+Asset+Management+Illustration" alt="IT Asset Management Illustration" class="rounded-lg shadow-xl">
                    </div>
                </div>
            </section>

            <!-- Mission and Vision Section -->
            <section class="py-16 bg-white" id="mission-vision">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-12">Our Mission and Vision</h2>

                    <div class="mb-10">
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Vision</h3>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Our vision is to transform the IT asset lifecycle management process into an efficient, paperless, and automated system, 
                            ensuring a seamless user experience for both staff and administrators.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Mission</h3>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Our mission is to provide a secure, transparent, and easily accessible platform for managing IT assets, 
                            tracking their status and location, and receiving real-time updates. We aim to enhance administrative efficiency 
                            and improve the overall utilization of college IT resources.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Services Offered Section -->
            <section class="py-16 bg-gray-50" id="services">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-12">Services Offered</h2>
                    
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Digital Asset Tracking:</h4>
                            <p class="text-lg text-gray-700">Easily track IT assets online, specifying asset type, model, and current assignment.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Asset Status Monitoring:</h4>
                            <p class="text-lg text-gray-700">Staff and administrators can view the real-time status of assets, including available, assigned, or under maintenance.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Automated Notifications:</h4>
                            <p class="text-lg text-gray-700">Instant alerts keep users informed about asset assignments, returns, and maintenance schedules.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Asset History Records:</h4>
                            <p class="text-lg text-gray-700">Maintains detailed logs of all past asset assignments, movements, and maintenance for auditing and reference.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- System Overview / Why Choose Us Section -->
            <section class="py-16 bg-white" id="system-overview">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-12">System Overview</h2>
                    <h3 class="text-3xl font-bold text-gray-800 text-center mb-8">Why Choose Us?</h3>

                    <div class="space-y-8">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Efficient Asset Lifecycle Management:</h4>
                            <p class="text-lg text-gray-700">Apply for, track, and manage IT assets with ease throughout their entire lifecycle.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Admin Privileges:</h4>
                            <p class="text-lg text-gray-700">Our website empowers administrators to manage users, departments, maintain asset records, and handle requests effectively.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Seamless Integration:</h4>
                            <p class="text-lg text-gray-700">Our platform integrates with existing systems to streamline asset allocation, tracking, and notification processes.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">User-Centered Design:</h4>
                            <p class="text-lg text-gray-700">We've designed the portal with staff, faculty, and administrators in mind, ensuring an intuitive user experience.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 py-8 text-white text-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-sm">&copy; Copyright 2023 JNEC IT Asset Management. All rights reserved.</p>
                <p class="text-xs mt-2">
                    <a href="#" class="hover:underline">Privacy Policy</a> | 
                    <a href="#" class="hover:underline">Terms of Service</a>
                </p>
            </div>
        </footer>

        <!-- Scroll to Top Button (Optional) -->
        <button id="scrollToTopBtn" class="fixed bottom-8 right-8 bg-emerald-600 hover:bg-emerald-700 text-white p-3 rounded-full shadow-lg transition-opacity duration-300 opacity-0 invisible">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Scroll to Top Button
                const scrollToTopBtn = document.getElementById('scrollToTopBtn');

                window.onscroll = function() {
                    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                        scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                        scrollToTopBtn.classList.add('opacity-100', 'visible');
                    } else {
                        scrollToTopBtn.classList.remove('opacity-100', 'visible');
                        scrollToTopBtn.classList.add('opacity-0', 'invisible');
                    }
                };

                scrollToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

                // Registration Success Modal Logic
                const registrationSuccessModal = document.getElementById('registrationSuccessModal');
                const modalMessage = document.getElementById('modalMessage');
                const modalLoginButton = document.getElementById('modalLoginButton');
                const urlParams = new URLSearchParams(window.location.search);
                const registeredEmail = urlParams.get('registered_email');

                // Check for session('registration_status') (Laravel Blade specific)
                // In a real Laravel app, this `session('registration_status')` would be set in your controller
                // For demonstration, we'll assume a URL parameter can also trigger it if `session()` isn't directly available in plain JS
                const hasRegistrationStatus = "{{ session('registration_status', '') }}" !== ''; // Check if Laravel session data exists
                
                if (hasRegistrationStatus || registeredEmail) { // Trigger if session is set OR if registered_email is in URL
                    if (hasRegistrationStatus) {
                        modalMessage.textContent = "{{ session('registration_status') }}";
                    } else if (registeredEmail) {
                        modalMessage.textContent = "Registration successful!"; // Default message if only email is present
                    }
                    
                    registrationSuccessModal.classList.add('show');

                    // If an email was passed, update the login button's href to pre-fill email
                    if (registeredEmail) {
                        modalLoginButton.href = "{{ route('login') }}?email=" + encodeURIComponent(registeredEmail);
                    }
                }

                // Close modal if clicking outside or via escape key
                registrationSuccessModal.addEventListener('click', function(event) {
                    if (event.target === registrationSuccessModal) {
                        registrationSuccessModal.classList.remove('show');
                    }
                });
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && registrationSuccessModal.classList.contains('show')) {
                        registrationSuccessModal.classList.remove('show');
                    }
                });
            });
        </script>
    </body>
</html>