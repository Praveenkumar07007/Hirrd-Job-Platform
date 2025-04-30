<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hirrd - Professional Recruitment Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Existing inline styles remain -->
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
        <!-- Header -->
        <header class="w-full px-6 py-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <nav class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <svg class="w-8 h-8 text-[#F53003] dark:text-[#FF4433]" viewBox="0 0 32 32" fill="currentColor">
                            <path d="M16 2L4 12v16h8V16h8v12h8V12L16 2z"/>
                        </svg>
                        <span class="text-xl font-semibold dark:text-white">Hirrd</span>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-secondary">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-primary">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-secondary">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="px-6 py-16 mx-auto max-w-7xl lg:px-8">
                <div class="mb-16 text-center">
                    <h1 class="mb-6 text-4xl font-bold lg:text-6xl dark:text-white">
                        Transform Your Talent Acquisition
                    </h1>
                    <p class="text-xl lg:text-2xl text-[#706f6c] dark:text-[#A1A09A] mb-8 max-w-3xl mx-auto">
                        Connect with exceptional candidates and optimize your recruitment process with our AI-powered matching technology and data-driven insights.
                    </p>

                    <div class="flex flex-col justify-center gap-4 mb-12 sm:flex-row">
                        <a href="{{ route('register') }}" class="btn-primary-lg">
                            Get Started Today
                        </a>
                        <a href="#features" class="btn-secondary-lg">
                            Explore Features
                        </a>
                    </div>
                </div>

                <!-- Features Grid -->
                <div id="features" class="grid gap-8 mb-24 md:grid-cols-3">
                    <div class="feature-card">
                        <div class="feature-icon bg-[#fff2f2] dark:bg-[#1D0002]">
                            <svg class="w-6 h-6 text-[#F53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Smart Matching</h3>
                        <p class="feature-description">AI-powered candidate matching for precise job fits</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon bg-[#fff2f2] dark:bg-[#1D0002]">
                            <svg class="w-6 h-6 text-[#F53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Fast Tracking</h3>
                        <p class="feature-description">Streamlined applicant tracking system</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon bg-[#fff2f2] dark:bg-[#1D0002]">
                            <svg class="w-6 h-6 text-[#F53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Analytics Dashboard</h3>
                        <p class="feature-description">Real-time recruitment analytics</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-[#161615] border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="px-6 py-12 mx-auto max-w-7xl lg:px-8">
                <div class="grid gap-8 mb-8 md:grid-cols-4">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-[#F53003] dark:text-[#FF4433]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            <span class="text-lg font-semibold dark:text-white">Hirrd</span>
                        </div>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            Revolutionizing recruitment through intelligent matching and streamlined processes.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h4 class="footer-heading">Company</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="footer-link">About Us</a></li>
                            <li><a href="#" class="footer-link">Careers</a></li>
                            <li><a href="#" class="footer-link">Blog</a></li>
                            <li><a href="#" class="footer-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h4 class="footer-heading">Resources</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="footer-link">Help Center</a></li>
                            <li><a href="#" class="footer-link">API Documentation</a></li>
                            <li><a href="#" class="footer-link">Privacy Guide</a></li>
                            <li><a href="#" class="footer-link">Security</a></li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h4 class="footer-heading">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="footer-link">Terms of Service</a></li>
                            <li><a href="#" class="footer-link">Privacy Policy</a></li>
                            <li><a href="#" class="footer-link">Cookie Policy</a></li>
                            <li><a href="#" class="footer-link">GDPR Compliance</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4 md:mb-0">
                        © 2023 Hirrd. All rights reserved.
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="social-icon">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z"/></svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.2-4.358-2.618-6.78-6.98-6.98C15.668 0 15.259 0 12 0z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
