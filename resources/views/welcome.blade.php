<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .logo-container {
            height: 32px; 
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 250px;
        }
        .nav-link {
            font-weight: 600;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #000000;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin: 5px; 
        }
        .nav-link:hover {
            background-color: #1a1a1a;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ asset('images/backg.png') }}" alt="Logo" class="h-64">
    </div>

    @if (Route::has('login'))
        <div class="buttons-container">
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
            @endauth
        </div>
    @endif
</body>
</html>
