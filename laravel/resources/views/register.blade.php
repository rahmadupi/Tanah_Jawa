<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <script src="https://unpkg.com/css-doodle@0.25.0/css-doodle.min.js"></script>
    <link rel="icon" href="{{ asset('assets/Logo.png') }}" type="image/x-icon">
</head>
<body>
    <div class="background-container">
        <css-doodle>
            <style>
                @grid: 50x1 / 50vmin;
                :container {
                    perspective: 23vmin;
                }
                background: @m(
                    @r(30, 30),
                    radial-gradient(
                        @p(#00E8E8) 100%,
                        transparent 0%
                    ) @r(100%) @r(100%) / @r(1%, 3%) @lr no-repeat
                );

                @size: 50%;
                @place-cell: center;

                border-radius: 50%;
                transform-style: preserve-3d;
                animation: scale-up 20s linear infinite;
                animation-delay: calc(@i * -.4s);

                @keyframes scale-up {
                    0% {
                        opacity: 0;
                        transform: translate3d(0, 0, 0) rotate(0);
                    }
                    10% {
                        opacity: 1;
                    }
                    95% {
                        transform:
                            translate3d(0, 0, @r(100vmin, 100vmin))
                            rotate(@r(-360deg, 360deg));
                    }
                    100% {
                        opacity: 0;
                        transform: translate3d(0, 0, 1vmin);
                    }
                }
            </style>
        </css-doodle>
    </div>
    <div class="main">
        <div class="login_register">
            <h2>REGISTER</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="button">Buat Akun</button>
            </form>
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
    <div class="home-button">
        <a href="{{ url('/') }}" class="button2">Home</a>
    </div>
</body>
</html>
