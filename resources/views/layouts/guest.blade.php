<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>JNEC IT Asset Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .auth-container {
                background: linear-gradient(135deg, #ac3ec8ff 0%, #764ba2 100%);
                min-height: 100vh;
            }
            .auth-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .logo-container {
                background: white;
                border-radius: 50%;
                padding: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border: 2px solid #e5e7eb;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-container flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Main Content Container -->
            <div class="w-full sm:max-w-md mt-6 px-6">
                <!-- Logo Section -->
                <div class="text-center mb-8">
                    <div class="flex justify-center items-center space-x-4 mb-6">
                        <!-- Your DIT Logo -->
                        <div class="logo-container">
                            <img src="{{ asset('image/dit_logo.png') }}" 
                                 alt="DIT JNEC Logo" 
                                 class="h-20 w-20 object-contain">
                        </div>
                    </div>
                    
                    <!-- System Title -->
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-white mb-2">JNEC IT</h1>
                        <p class="text-white text-opacity-90 text-lg">Asset Management System</p>
                        <p class="text-white text-opacity-80 text-sm mt-2">Login to your account</p>
                    </div>
                </div>

                <!-- Authentication Card -->
                <div class="auth-card px-6 py-8">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-white text-opacity-80 text-sm">
                        &copy; {{ date('Y') }} JNEC IT Department. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>