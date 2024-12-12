<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
    <link rel="stylesheet" href="{{ asset('css/article.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" />
    <script src="https://unpkg.com/css-doodle@0.25.0/css-doodle.min.js"></script>
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
    <div class="outer">
        <div class="main">
            <div class="additional-content">
                @foreach ($articles as $article)
                    <div class="item">
                        <div class="image">
                            <img src="{{ $article->gambar }}" alt="Placeholder Image" />
                        </div>
                        <div class="text">
                            <div class="title"><h4>{{ $article->judul }}</h4></div>
                            <div class="description">
                                <p>{{ $article->deskripsi }}</p>
                            </div>
                        </div>
                        <a href="{{ route('konten.show', ['id' => $article->index]) }}" class="button2">Baca</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="home-button">
        <a href="{{ url('/') }}" class="button2">Home</a>
    </div>
    <script>
        @if(isset($logMessage))
            console.log(@json($logMessage));
        @endif
    </script>
</body>
</html>
