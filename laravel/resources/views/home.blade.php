<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <script src="{{ asset('js/scripts.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="menu">
                <img src="{{ asset('assets/Logo.png') }}" alt="Logo">
                <a href="{{ url('#artikel') }}">Artikel</a>
                <a href="{{ url('#leaderboard') }}">Leaderboard</a>
            </div>
            <div class="username">
                @auth
                    <button id="usernameButton" class="username-button">{{ Auth::user()->name }}</button>
                    <div id="dropdown" class="dropdown-content">
                        <form method="post" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                @else
                    <button id="usernameButton" class="username-button">Guest</button>
                    <div id="dropdown" class="dropdown-content">
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    </div>
                @endauth
            </div>
        </div>
        <div class="content">
            <div class="main-content">
                <h1>Kuis Sejarah</h1>
                <h2>Indonesia</h2>
                <button class="button">Take Quiz</button>
                <button class="button">Learn</button>
            </div>
            <div class="section-header">
                <hr class="section-line">
            </div>

            <div class="third" id="leaderboard">
                <div class="section-header">
                    <div class="section-title">
                        <hr class="section-line">
                        <h4>Leaderboard</h4>
                        <hr class="section-line">
                    </div>
                </div>
                <div class="additional-content">
                    <table class="leaderboard">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Total Nilai</th>
                                <th>Tanggal Kuis Terakhir</th>
                            </tr>
                        </thead>
                        <tbody id="leaderboard-value">
                            @foreach ($leaderboard as $entry)
                                <tr>
                                    <td>{{ $entry->username }}</td>
                                    <td>{{ $entry->total_nilai }}</td>
                                    <td>{{ $entry->tanggal_kuis_terakhir }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="second" id="artikel">
                <div class="section-header">
                    <div class="section-title">
                        <h4>Artikel</h4>
                        <hr class="section-line">
                        <a href="{{ url('/') }}">Buka Halaman Artikel&#x1F517</a>
                    </div>
                </div>
                <div class="additional-content">
                    @foreach ($articles as $article)
                        <div class="item">
                            <div class="image">
                                <img src="{{ $article->image_url }}" alt="Placeholder Image">
                            </div>
                            <div class="text">
                                <div class="title"><h4>{{ $article->title }}</h4></div>
                                <div class="description"><p>{{ $article->description }}</p></div>
                            </div>
                            <button class="button2">Baca</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
