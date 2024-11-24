<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --nav-bg: #ffffff;
            --nav-hover: #f3f4f6;
            --nav-active: #e5e7eb;
            --text-primary: #111827;
            --text-secondary: #4b5563;
        }

        .transition-smooth {
            transition: all 0.2s ease-in-out;
        }

        .nav-container {
            @apply bg-white border-r shadow-sm;
            position: fixed;
            height: 100%;
            z-index: 40;
        }

        .nav-link {
            @apply flex items-center gap-4 px-8 py-8 text-gray-600 rounded-lg transition-all duration-200 ease-in-out my-1;
        }

        .nav-link:hover {
            @apply bg-gray-50 text-gray-900;
        }

        .nav-link.active {
            @apply bg-gray-100 text-gray-900 font-medium;
        }

        .nav-icon {
            @apply text-gray-500 group-hover:text-gray-700 w-6 h-6;
        }

        .nav-section {
            @apply space-y-4 pb-8;
        }

        .nav-section-title {
            @apply px-6 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider;
        }

        .profile-dropdown {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Main content area adjustments */
        .main-content {
            transition: margin-left 0.3s ease-in-out;
        }

        @media (min-width: 1024px) {
            .main-content {
                margin-left: 18rem; /* 72px = width of sidebar */
            }
        }

        /* Mobile navigation */
        @media (max-width: 1023px) {
            .nav-container {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .nav-container.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .nav-overlay {
                position: fixed;
                inset: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 30;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease-in-out;
            }

            .nav-overlay.show {
                opacity: 1;
                pointer-events: auto;
            }
        }

        /* Header enhancements */
        .header-dropdown {
            @apply relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-lg
                   hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500;
        }

        .header-container {
            position: relative;
            width: 100%;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div x-data="{ open: false }" class="min-h-screen flex">
        <!-- Improved Sidebar -->
        <div :class="open ? 'translate-x-0' : '-translate-x-full'" 
        class="fixed inset-y-0 left-0 z-30 w-64 bg-white overflow-y-auto transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-lg">
            <!-- Logo Section -->
            <div class="flex items-center justify-center h-16 px-6 border-b border-slate-700/50">
                <a href="{{ route('dashboard') }}" class="block transition-transform duration-200 hover:scale-105">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-12 w-auto rounded-lg shadow-lg">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-10 space-y-1 overflow-y-auto" role="navigation" aria-label="Main Navigation">
                    <!-- Dashboard Link -->
                     <li>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        <span>{{ __('Schedules') }}</span>
                    </x-nav-link>
                    </li>

                    <!-- Role-based Navigation -->
                    @if(Auth::user()->isAdmin())
                        <!-- Admin Links with Icons -->
                        <div class="space-y-1 pt-2">
                            <li>
                            <x-nav-link :href="route('admin.manage.schedules')" :active="request()->routeIs('admin.manage.schedules')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4h-1m0 0a2 2 0 11-4 0H8a2 2 0 11-4 0H3m16 0v18M3 4v18m4-6h.01M7 8h.01M7 12h.01M11 8h.01M11 12h.01M11 16h.01M15 8h.01M15 12h.01M15 16h.01"/>
                                </svg>
                                <span>{{ __('Manage Schedules') }}</span>
                            </x-nav-link>
                            </li>
                            <li>
                            <x-nav-link :href="route('admin.admin.dashboard')" :active="request()->routeIs('admin.admin.dashboard')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ __('Bus GPS') }}</span>
                            </x-nav-link>
                            </li>
                            <li>
                            <x-nav-link :href="route('admin.manage.buses')" :active="request()->routeIs('admin.manage.buses')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                                <span>{{ __('Manage Buses') }}</span>
                            </x-nav-link>
                            </li>
                            <li>
                            <x-nav-link :href="route('admin.register.driver.form')" :active="request()->routeIs('admin.register.driver.form')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ __('Register Driver') }}</span>
                            </x-nav-link>
                            </li>
                            <li>
                            <x-nav-link :href="route('admin.register.conductor.form')" :active="request()->routeIs('admin.register.conductor.form')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>{{ __('Register Conductor') }}</span>
                            </x-nav-link>
                            </li>
                            <li>
                            <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span>{{ __('View Reports') }}</span>
                            </x-nav-link>
                            </li>
                            <li>

                            <x-nav-link :href="route('admin.register.checkpoint.user.form')" :active="request()->routeIs('admin.register.checkpoint.user.form')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ __('Register Checkpoint User') }}</span>
                            </x-nav-link>
                            </li>
                            <li>

                            <x-nav-link :href="route('fares.index')" :active="request()->routeIs('fares.*')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>{{ __('Manage Fares') }}</span>
                            </x-nav-link>
                            </li>
                            <li>
                            <x-nav-link :href="route('admin.bus.bookings')" :active="request()->routeIs('admin.bus.bookings')" class="nav-link">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                <span>{{ __('Manage Bookings') }}</span>
                            </x-nav-link>
                            </li>
                        </div>
                    @endif

                        @if(Auth::user()->isDriver())
                                <div class="space-y-1 pt-2">
                                <li>
                                    <x-nav-link :href="route('driver.qrcode')" :active="request()->routeIs('driver.qrcode')" class="nav-link">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ __('QR Code') }}</span>
                                    </x-nav-link>
                                </li>
                                    <li>
                                    <x-nav-link :href="route('driver.checkpoints')" :active="request()->routeIs('driver.checkpoints')" class="text-lg">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                        {{ __('Checkpoints') }}
                                    </x-nav-link>
                                    </li>
                                </div>
                            @endif

                            <!-- Checkpoint Links -->
                            @if(Auth::user()->isCheckpoint())
                                <li>
                                    <x-nav-link :href="route('checkpoint.scan')" :active="request()->routeIs('checkpoint.scan')" class="text-lg">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                        </svg>
                                        {{ __('Scan QR Code') }}
                                    </x-nav-link>
                                </li>
                            @endif

                            <!-- Passenger Links -->
                            @if(Auth::user()->isPassenger())
                                <li>
                                    <x-nav-link :href="route('passenger.report.form')" :active="request()->routeIs('passenger.report.form')" class="text-lg">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        {{ __('Report a Bus') }}
                                    </x-nav-link>
                                </li>
                                <li>
                                    <x-nav-link :href="route('passenger.bookings')" :active="request()->routeIs('passenger.bookings')" class="text-lg">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                        {{ __('My Bus Bookings') }}
                                    </x-nav-link>
                                </li>
                            @endif
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Enhanced Header -->
            <header class="bg-white border-b shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <!-- Mobile menu button -->
                    <button @click="open = !open" type="button" 
                            class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="header-dropdown">
                                    <span class="mr-2">{{ Auth::user()->name }}</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>{{ __('Profile') }}</span>
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" 
                                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                                   class="flex items-center space-x-2 text-red-600 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>{{ __('Log Out') }}</span>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>

        <!-- Mobile Overlay -->
        <div x-show="open" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="sidebar-overlay lg:hidden"
             @click="open = false">
        </div>
    </div>
</body>
</html>