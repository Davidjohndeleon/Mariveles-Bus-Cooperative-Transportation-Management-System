<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ffffff;
            --secondary-color: #f0f0f0;
            --accent-color: #ff6b6b;
            --text-color: #2d3748;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--primary-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
        }

        .welcome-container {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            width: 100%;
            animation: fadeIn 1s ease-out;
        }

        .logo {
            margin-bottom: 2rem;
            max-width: 150px; /* Smaller logo */
            height: auto;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .buttons-container {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: slideUp 0.8s ease-out;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-color);
            text-decoration: none;
            padding: 1rem 2rem;
            background-color: rgba(0, 0, 0, 0.05);
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            background-color: rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 1s ease-out;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-text p {
            font-size: 1.2rem;
            opacity: 0.8;
            max-width: 600px;
            margin: 0 auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .welcome-text h1 {
                font-size: 2rem;
            }
            
            .welcome-text p {
                font-size: 1rem;
            }
            
            .nav-link {
                padding: 0.875rem 1.5rem;
            }
            
            .logo {
                max-width: 100px; /* Even smaller on mobile */
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <a href="login" class="flex justify-center">
            <img src="{{ asset('images/busnobg.png') }}" alt="Logo" class="logo">
        </a>

        <div class="welcome-text">
            <h1>Welcome to Balanga-Mariveles</h1>
            <h2>MINI BUS TRANSPORTATION SYSTEM</h2>
            <p>Your trusted mini bus transportation system, connecting communities with comfort and reliability.</p>
        </div>

        <div class="buttons-container">
            <a href="{{ route('login') }}" class="nav-link">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            @endif
        </div>
    </div>
</body>
</html>