<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — My Perfect Stitch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #100736;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        /* Subtle dot-grid pattern over navy */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(249,176,64,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .login-wrap {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }

        /* Logo area */
        .logo-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 28px;
        }

        .logo-area img {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #F9B040;
            margin-bottom: 14px;
            box-shadow: 0 0 0 6px rgba(249,176,64,0.12);
        }

        .logo-area h1 {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.01em;
        }

        .logo-area p {
            font-size: 11px;
            font-weight: 500;
            color: rgba(249,176,64,0.7);
            letter-spacing: 0.18em;
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* Card */
        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 32px 28px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.35);
        }
        @media (min-width: 480px) { .login-card { padding: 40px 36px; } }

        .card-heading {
            font-size: 17px;
            font-weight: 600;
            color: #100736;
            margin-bottom: 4px;
        }
        .card-sub {
            font-size: 12px;
            color: #6b6882;
            margin-bottom: 28px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #6b6882;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            background: #F7F5F2;
            border: 1.5px solid #e8e4f0;
            color: #100736;
            padding: 11px 14px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            margin-bottom: 18px;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #F9B040;
            box-shadow: 0 0 0 3px rgba(249,176,64,0.15);
            background: #fff;
        }
        input::placeholder { color: #9896a8; }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }
        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #F9B040;
            margin: 0;
            flex-shrink: 0;
        }
        .remember-row label {
            margin: 0;
            font-size: 13px;
            color: #6b6882;
            font-weight: 400;
            cursor: pointer;
        }

        .btn-signin {
            width: 100%;
            background: #100736;
            color: #fff;
            padding: 13px;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            letter-spacing: 0.03em;
        }
        .btn-signin:hover { background: #1a0f4a; }
        .btn-signin:active { transform: scale(0.99); }

        .gold-divider {
            height: 3px;
            background: #F9B040;
            border-radius: 0 0 12px 12px;
            margin-top: -3px;
        }

        .error-alert {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #c0392b;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .footer-text {
            text-align: center;
            font-size: 11px;
            color: rgba(255,255,255,0.25);
            margin-top: 24px;
        }
    </style>
</head>
<body>
<div class="login-wrap">

    <!-- Logo -->
    <div class="logo-area">
        <img src="{{ asset('images/logo.jpg') }}" alt="My Perfect Stitch Logo">
        <h1>My Perfect Stitch</h1>
        <p>Operations Suite</p>
    </div>

    <!-- Card -->
    <div class="login-card">
        <div class="card-heading">Welcome back</div>
        <div class="card-sub">Sign in to your operations dashboard</div>

        @if($errors->any())
            <div class="error-alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   placeholder="you@myperfectstitch.co.zm"
                   value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="••••••••" required>

            <div class="remember-row">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Keep me signed in</label>
            </div>

            <button type="submit" class="btn-signin">Sign In</button>
        </form>
    </div>
    <div class="gold-divider"></div>

    <p class="footer-text">My Perfect Stitch &copy; {{ date('Y') }} &middot; Lusaka, Zambia &middot; Creating Happiness</p>
</div>
</body>
</html>
