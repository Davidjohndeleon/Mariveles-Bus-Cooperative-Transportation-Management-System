<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Custom Styles -->
        <style>
            body {
                background: linear-gradient(to bottom, #ffffff, #1e3c72); /* Gradient background */
                font-family: 'Figtree', sans-serif;
            }

            .logo-container {
                text-align: center;
                margin-top: 20px;
            }

            .logo-container h1 {
                font-size: 2.5em;
                font-weight: bold;
                color: #1e3c72;
            }

            .logo-container h2 {
                font-size: 1.5em;
                color: #1e3c72;
                margin-bottom: 40px;
            }

            .login-container {
                background: rgba(255, 255, 255, 0.8); /* White background with some transparency */
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                margin: auto;
            }

            .login-container label {
                color: #1e3c72;
                font-weight: bold;
            }

            .login-container a {
                color: #1e3c72;
            }

            .login-container .btn-primary {
                background-color: #1e3c72;
                color: #fff;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="logo-container">
                <h1>BALANGA - MARIVELES</h1>
                <h2>MINI BUS TRANSPORTATION SYSTEM</h2>
            </div>
            
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="login-container">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
