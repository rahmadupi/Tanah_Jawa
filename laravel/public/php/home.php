<?php
session_start();

function get_user() {
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    } elseif (isset($_COOKIE['username'])) {
        return $_COOKIE['username'];
    } else {
        return 'Guest';
    }
}

function get_leaderboard() {}

function get_article() {}

function route_to_article() {}

function route_to_quiz() {}

function logout() {
    session_unset();
    session_destroy();
    setcookie('username', '', time() - 3600);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    logout();
}

$username = get_user();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="../css/font.css" />
    <script src="home.js" defer></script>
  </head>
  <body>
    <div class="container">
        <div div class="header">
            <div class="menu">
                <img src="./Logo.png" >
                <a href="./">Artikel</a>
                <a href="./">Leaderboard</a>

            </div>
            <div class="username">
                <button id="usernameButton" class="username-button"><?php echo htmlspecialchars($username); ?></button>
                <div id="dropdown" class="dropdown-content">
                    <?php if ($username === 'Guest'): ?>
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    <?php else: ?>
                        <form method="post" action="">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit">Logout</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="main-inner">
            <div class="content">
            <div class="main-content">
                <h1>Kuis Sejarah</h1>
                <h2>Indonesia</h2>
                <button class="button">Take Quiz</button>
                <button class="button">Learn</button>
            </div>
            <!-- <div class="right">
                <table class="leaderboard">
                <thead>
                    <tr>
                    <th>Username</th>
                    <th>Nilai</th>
                    <th>Date</th>
                    </tr>
                </thead>
                <tbody id="leaderboard-value">
                    <tr>
                    <td>user1</td>
                    <td>90</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td>user2</td>
                    <td>85</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                </tbody>
                </table>
            </div> -->
            </div>
        </div>
        </div>
        <div class="second">
            <div class="section-header">
                <hr class="section-line">
                <div class="section-title">
                    <h2>Artikel</h2>
                    <hr class="section-line">
                    <a href="">Buka Halaman Artikel&#x1F517</a>
                </div>
            </div>
            <div class="additional-content">
                <div class="item">
                    <div class="image">
                        <img src="https://via.placeholder.com/400x225" alt="Placeholder Image">
                    </div>
                    <div class="text">
                        <div class="title"><h4>Title 1</h4></div>
                        <div class="description"><p>Description 1<p></div>
                    </div>
                    <button class="button2">Baca</button>
                </div>
                <div class="item">
                    <div class="image">
                        <img src="https://via.placeholder.com/400x225" alt="Placeholder Image">
                    </div>
                    <div class="text">
                        <div class="title"><h4>Title 1</h4></div>
                        <div class="description"><p>Description 1<p></div>
                    </div>
                    <button class="button2">Baca</button>
                </div>
                <div class="item">
                    <div class="image">
                        <img src="https://via.placeholder.com/400x225" alt="Placeholder Image">
                    </div>
                    <div class="text">
                        <div class="title"><h4>Title 1</h4></div>
                        <div class="description"><p>Description 1<p></div>
                    </div>
                    <button class="button2">Baca</button>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>

