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
       
        .sidebar {
            background-color: #2D3748; 
            color: #fff;
            transition: transform 0.3s ease;
        }

        
        .sidebar img {
            transition: transform 0.3s ease;
        }

        .sidebar img:hover {
            transform: scale(1.1);
        }

        
        nav ul li a {
            padding: 12px 20px; 
            font-size: 1.125rem; 
            transition: background-color 0.3s ease, color 0.3s ease;
            display: block;
            text-decoration: none;
            color: #edf2f7; 
        }

       
        nav ul li a:hover {
            background-color: #4A5568; 
            color: #ffffff !important; 
            border-radius: 5px; 
        }

       
        nav ul li a.active {
            background-color: #3182CE; 
            color: #ffffff !important; 
            border-left: 4px solid #63B3ED; 
        }

        
        button {
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4A5568; 
        }

        .x-dropdown button {
            border: none;
            background-color: transparent;
            color: #EDF2F7;
            display: flex;
            align-items: center;
        }

        .x-dropdown button:hover {
            background-color: #4A5568;
            color: #fff;
        }

    
        nav ul li {
            margin-bottom: 12px;
        }

        
        @media (max-width: 1024px) {
            .sidebar {
                width: 100%;
                max-width: 250px;
            }

            .x-dropdown button {
                display: none; 
            }

            
            button {
                background-color: #3182CE;
                border-radius: 5px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div x-data="{ open: false }" class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        <div :class="open ? 'translate-x-0' : '-translate-x-full'" 
             class="fixed inset-y-0 left-0 z-30 w-64 bg-white overflow-y-auto transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-lg">
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-16 w-auto">
                </a>
            </div>
            <nav class="mt-5">
                <ul class="space-y-2">
                    <!-- Common Link -->
                    <li>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Schedules') }}
                        </x-nav-link>
                    </li>
                    <!-- Admin Links -->
                    @if(Auth::user()->isAdmin())
                        <li><x-nav-link :href="route('admin.manage.schedules')" :active="request()->routeIs('admin.manage.schedules')">{{ __('Manage Schedules') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.admin.dashboard')" :active="request()->routeIs('admin.admin.dashboard')">{{ __('Bus GPS') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.manage.buses')" :active="request()->routeIs('admin.manage.buses')">{{ __('Manage Buses') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.register.driver.form')" :active="request()->routeIs('admin.register.driver.form')">{{ __('Register Driver') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.register.conductor.form')" :active="request()->routeIs('admin.register.conductor.form')">{{ __('Register Conductor') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index')">{{ __('View Reports') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.register.checkpoint.user.form')" :active="request()->routeIs('admin.register.checkpoint.user.form')">{{ __('Register Checkpoint User') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('fares.index')" :active="request()->routeIs('fares.*')">{{ __('Manage Fares') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('admin.bus.bookings')" :active="request()->routeIs('admin.bus.bookings')">{{ __('Manage Bookings') }}</x-nav-link></li>
                    @endif
                    <!-- Driver Links -->
                    @if(Auth::user()->isDriver())
                        <li><x-nav-link :href="route('driver.qrcode')" :active="request()->routeIs('driver.qrcode')">{{ __('QR Code') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('driver.checkpoints')" :active="request()->routeIs('driver.checkpoints')">{{ __('Checkpoints') }}</x-nav-link></li>
                    @endif
                    <!-- Checkpoint Links -->
                    @if(Auth::user()->isCheckpoint())
                        <li><x-nav-link :href="route('checkpoint.scan')" :active="request()->routeIs('checkpoint.scan')">{{ __('Scan QR Code') }}</x-nav-link></li>
                    @endif
                    <!-- Passenger Links -->
                    @if(Auth::user()->isPassenger())
                        <li><x-nav-link :href="route('passenger.report.form')" :active="request()->routeIs('passenger.report.form')">{{ __('Report a Bus') }}</x-nav-link></li>
                        <li><x-nav-link :href="route('passenger.bookings')" :active="request()->routeIs('passenger.bookings')">{{ __('My Bus Bookings') }}</x-nav-link></li>
                    @endif
                </ul>
            </nav>
        </div>

        <div class="flex-1">
            <!-- Page Heading -->
            <header class="flex items-center justify-between px-4 py-2 bg-white border-b shadow-md">
                <!-- Sidebar Toggle (visible on small screens) -->
                <button @click="open = !open" class="text-gray-500 hover:text-gray-700 focus:outline-none lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
