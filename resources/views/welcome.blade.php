<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
    
    <style>
        :root {
            --primary-color: #1e3c72;
            --secondary-color: #2a5298;
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
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 0;
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

        .logo-container {
            margin-bottom: 3rem;
            animation: floatAnimation 3s ease-in-out infinite;
            position: relative;
        }

        .logo-container img {
            height: auto;
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
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
            color: #ffffff;
            text-decoration: none;
            padding: 1rem 2rem;
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-link:hover::before {
            width: 300px;
            height: 300px;
        }

        .welcome-text {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
            animation: fadeIn 1s ease-out;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .welcome-text p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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

        @keyframes floatAnimation {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
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
            
            .logo-container {
                margin-bottom: 2rem;
            }
        }

        /* Add a subtle particle effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: moveParticle 8s infinite linear;
        }

        @keyframes moveParticle {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100vw);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Particle effect container -->
    <div class="particles">
        @for ($i = 0; $i < 20; $i++)
            <div class="particle" style="
                left: {{ rand(0, 100) }}%;
                top: {{ rand(0, 100) }}%;
                animation-delay: {{ $i * 0.5 }}s;
            "></div>
        @endfor
    </div>

    <div class="welcome-container">
        <div class="logo-container">
            <img src="{{ asset('images/backg.png') }}" alt="Logo" class="h-64">
        </div>

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