<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
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
                        transparent 10%
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
            <h2>LOGIN</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input">
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                    <small class="login-error">{{ $errors->first('email') }}</small>
                    @endif
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                    <small class="login-error">{{ $errors->first('password') }}</small>
                    @endif
                </div>
                <button type="submit" class="button">Login</button>
            </form>
            <p>Tidak punya akun? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
    <div class="home-button">
        <a href="{{ url('/') }}" class="button2">Home</a>
    </div>
</body>
</html>
