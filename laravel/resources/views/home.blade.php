<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="icon" href="{{ asset('assets/Logo.png') }}" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="menu">
                <img src="{{ asset('assets/Logo.png') }}" alt="Logo" id="logo" href="#">
                <a href="{{ url('#artikel') }}">Artikel</a>
                <a href="{{ url('#leaderboard') }}">Leaderboard</a>
            </div>
            <div class="username">
                @auth
                    <button id="usernameButton" class="username-button">{{ Auth::user()->username }}</button>
                    <div id="dropdown" class="dropdown-content">
                        <!-- <form method="post" action="{{ url('/logout') }}">
                            @csrf
                        </form> -->
                        <button id="logout_button" type="submit">Logout</button>
                    </div>
                @else
                    <button id="usernameButton" class="username-button">Guest</button>
                    <div id="dropdown" class="dropdown-content">
                        <a id="login_button" href="{{ url('/login') }}">Login</a>
                        <a id="register_button" href="{{ url('/register') }}">Register</a>
                    </div>
                @endauth
            </div>
        </div>
        <div class="main" id="main">
            <div class="main-inner">
                <div class="content">
                    <div class="main-content">
                        <h1>Kuis Sejarah</h1>
                        <h2>Indonesia</h2>
                        <a class="button" href="{{ url('/kuis') }}">Take Quiz</a>
                        <a class="button" href="{{ url('/article') }}">Learn</a>
                    </div>
                </div>
            </div>
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
                                <th>Last take</th>
                            </tr>
                        </thead>
                        <tbody id="leaderboard-value">
                                @foreach ($leaderboard as $entry)
                                <tr>
                                    <td>{{ $entry->username}}</td>
                                    <td>{{ $entry->score }}</td>
                                    <td>{{ $entry->last_take }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="second" id="artikel">
                @if ($articles->isNotEmpty())
                <div class="section-header">
                    <div class="section-title">
                        <h4>Artikel</h4>
                        <hr class="section-line">
                        <a href="{{ url('/article') }}">Buka Halaman Artikel&#x1F517</a>
                    </div>
                </div>
                <div class="additional-content">
                    @foreach ($articles as $article)
                        <div class="item">
                            <div class="image">
                            <!-- asset('assets/Logo.png') -->
                                <img src="{{ asset($article->gambar) }}" alt="Placeholder Image">
                            </div>
                            <div class="text">
                                <div class="title"><h4>{{ $article->judul }}</h4></div>
                                <div class="description"><p>{{ $article->deskripsi }}</p></div>
                            </div>
                            <a href="{{ route('konten.show', ['id' => $article->index]) }}" class="button2">Baca</a>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            @if ($articles->isEmpty())
                <div style="margin-bottom: 100px;">sda</div>
            @endif
        </div>

        <div class="outer-modal" id="modal-parrent">
            <div id="logout_modal" class="modal">
                <div class="modal-content">
                    <p>Beneran Logout?</p>
                    <form method="post" action="{{ url('/logout') }}">
                        @csrf
                        <!-- <button id="logout_button" type="submit">Logout</button> -->
                        <button type="submit" class="button2">Yes</button>
                        <button type="submit" id="cancel_button" class="button2">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/home.js') }}" defer></script>
    </body>
</html>
