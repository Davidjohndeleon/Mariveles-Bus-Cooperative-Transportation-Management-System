<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-color: #1e3c72;
            --secondary-color: #2a5298;
            --accent-color: #ff6b6b;
            --text-primary: #2c3e50;
            --text-secondary: #34495e;
        }

        body {
            min-height: 100vh;
            background: white;
            color: var(--text-primary);
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
        }

        .page-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: white;
        }

        .app-logo {
            margin-bottom: 2rem;
            animation: fadeInDown 0.8s ease-out;
        }

        .app-logo a {
            display: block;
            transition: transform 0.3s ease;
        }

        .app-logo a:hover {
            transform: scale(1.05);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 1s ease-out;
        }

        .logo-container h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            letter-spacing: 1px;
        }

        .logo-container h2 {
            font-size: 1.5rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            animation: fadeInUp 1s ease-out;
            border: 1px solid #e2e8f0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .form-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }

        .submit-button {
            width: 100%;
            padding: 0.875rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        .forgot-password {
            display: block;
            text-align: right;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--accent-color);
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
            color: var(--text-secondary);
        }

        .remember-me input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .logo-container h1 {
                font-size: 2rem;
            }
            
            .logo-container h2 {
                font-size: 1.25rem;
            }
            
            .login-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="logo-container">
            <h1>BALANGA - MARIVELES</h1>
            <h2>MINI BUS TRANSPORTATION SYSTEM</h2>
        </div>

        <div class="app-logo">
            <a href="/">
                <x-application-logo/>
            </a>
        </div>

        <div class="login-container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>