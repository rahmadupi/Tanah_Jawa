<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Kuis</title>
        <link rel="stylesheet" href="{{ asset('css/kuis.css') }}" />
        <link rel="icon" href="{{ asset('assets/Logo.png') }}" type="image/x-icon">
        <link
            href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap"
            rel="stylesheet"
        />
    </head>
    <body>
        <audio id="backsoundAudio" src="{{ asset('audio/backsound.m4a') }}" loop></audio>
        <audio id="hoverSound" src="{{ asset('audio/bubbleSFX.mp3') }}"></audio>
        <audio id="correctSound" src="{{ asset('audio/correctSFX.mp3') }}"></audio>
        <audio id="incorrectSound" src="{{ asset('audio/incorrectSFX.mp3') }}"></audio>

        <div class="line"></div>
        <div class="options-container">
            <div class="option" id="option-1" data-index="1"></div>
            <div class="option" id="option-2" data-index="2"></div>
            <div class="option" id="option-3" data-index="3"></div>
            <div class="option" id="option-4" data-index="4"></div>
        </div>
        <div class="something">
            <div class="pause-icon" id="pauseBtn"></div>
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>
            <div class="heartContainer">
                <img
                    src="{{ asset('assets/fullHeart.png') }}"
                    class="heart"
                    id="fullHeart"
                    alt=""
                />
                <img
                    src="{{ asset('assets/leftHeart.png') }}"
                    id="leftHeart"
                    class="heart"
                    alt="Left Half"
                />
                <img
                    src="{{ asset('assets/rightHeart.png') }}"
                    id="rightHeart"
                    class="heart"
                    alt="Right Half"
                />
            </div>
            <div class="heart-number" id="heartAmmount"></div>
        </div>
        <div class="blur" id="menuBlur" style="display: none"></div>
        <div class="menu" id="menuForm" style="display: none">
            <p>MENU</p>
            <div class="container">
                <a class="menu-option" id="returnHomeBtn">HOME</a>
                <a class="menu-option" id="restartBtn">RESTART</a>
                <a class="menu-option" id="settingBtn">SETTINGS</a>
            </div>
        </div>
        <div class="settingOption" id="settingForm">
            <label for="musicVolume">Music Volume:</label>
            <input type="range" id="musicVolume" min="0" max="100" value="40" />
            <label for="sfxVolume">SFX Volume:</label>
            <input type="range" id="sfxVolume" min="0" max="100" value="100" />
        </div>
        <div class="question-box">
            <div class="circle">?</div>
            <div class="chatBubble"></div>
            <div class="question" id="question"></div>
        </div>
        <div class="gameOverForm" id="successForm">
            <p id="gameOverMessage">CONGRATULATION!</p>
            <div class="accuracyDisplay" id="accuracyDisplay">
                <div class="accuracyCircle"></div>
                <div class="accuracyPercentage" id="accuracyPercentage"></div>
                <div class="accuracyText">0</div>
            </div>
            <div class="statisticContainer" id="statisticForm">
                <div
                    class="statisticContainerChild"
                    id="correctDisplay"
                    style="border: 5px solid rgb(77, 255, 0)"
                >
                    <div
                        class="label"
                        style="background-color: rgb(77, 255, 0)"
                    >
                        Correct
                    </div>
                    <div class="value" id="correctStat">0</div>
                </div>
                <div
                    class="statisticContainerChild"
                    id="incorrectDisplay"
                    style="border: 5px solid rgb(247, 60, 60)"
                >
                    <div
                        class="label"
                        style="background-color: rgb(247, 60, 60)"
                    >
                        Incorrect
                    </div>
                    <div class="value" id="incorrectStat">0</div>
                </div>
                <div
                    class="statisticContainerChild"
                    id="scoreDisplay"
                    style="border: 5px solid rgb(255, 136, 0)"
                >
                    <div
                        class="label"
                        style="background-color: rgb(255, 136, 0)"
                    >
                        Streak
                    </div>
                    <div class="value" id="streakStat">0</div>
                </div>
                <div
                    class="statisticContainerChild"
                    id="streakDisplay"
                    style="border: 5px solid rgb(45, 147, 255)"
                >
                    <div
                        class="label"
                        style="background-color: rgb(45, 147, 255)"
                    >
                        Score
                    </div>
                    <div class="value" id="scoreStat">0</div>
                </div>
            </div>
            <div class="container2" id="container2">
                <div class="tryAgainBtn" id="tryAgainBtnSuccess">Try Again</div>
                <div class="returnHomeBtn2" id="returnHomeBtnSuccess">
                    Return Home
                </div>
            </div>
        </div>
        <div class="gameOverForm" id="failForm">
            <p id="gameOverMessage" style="top: 25%; left: 45%">SORRY</p>
            <p
                style="
                    position: absolute;
                    top: 40%;
                    left: 42%;
                    font-size: 1.5rem;
                "
            >
                You Run Out Of Heart
            </p>
            <div
                class="container2"
                id="container22"
                style="top: 60%; left: 33.6%"
            >
                <div class="tryAgainBtn" id="tryAgainBtnFail">Try Again</div>
                <div class="returnHomeBtn2" id="returnHomeBtnFail">
                    Return Home
                </div>
            </div>
        </div>

        <script src="{{ asset('js/kuis.js') }}"></script>
    </body>
</html>
