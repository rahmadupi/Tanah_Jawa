// Elemen DOM
const backsoundAudio = document.getElementById("backsoundAudio");
const hoverSound = document.getElementById("hoverSound");
const correctSound = document.getElementById("correctSound");
const incorrectSound = document.getElementById("incorrectSound");

const pauseBtn = document.getElementById("pauseBtn");
const menuForm = document.getElementById("menuForm");
const menuBlur = document.getElementById("menuBlur");
const restartBtn = document.getElementById("restartBtn");
const returnHomeBtn = document.getElementById("returnHomeBtn");
const settingBtn = document.getElementById("settingBtn");
const settingForm = document.getElementById("settingForm");
const musicVolumeSlider = document.getElementById("musicVolume");
const sfxVolumeSlider = document.getElementById("sfxVolume");
const progress = document.getElementById("progress");

const leftHeart = document.getElementById("leftHeart");
const rightHeart = document.getElementById("rightHeart");
const fullHeart = document.getElementById("fullHeart");
const heartAmmount = document.getElementById("heartAmmount");

const question = document.getElementById("question");
const option_1 = document.getElementById("option-1");
const option_2 = document.getElementById("option-2");
const option_3 = document.getElementById("option-3");
const option_4 = document.getElementById("option-4");

const successForm = document.getElementById("successForm");
const failForm = document.getElementById("failForm");
const gameOverMessage = document.getElementById("gameOverMessage");
const accuracyDisplay = document.getElementById("accuracyDisplay");
const accuracyPercentage = document.querySelector(".accuracyPercentage");
const accuracyText = document.querySelector(".accuracyText");
const statisticForm = document.getElementById("statisticForm");
const correctStat = document.getElementById("correctStat");
const incorrectStat = document.getElementById("incorrectStat");
const streakStat = document.getElementById("streakStat");
const scoreStat = document.getElementById("scoreStat");

const container2 = document.getElementById("container2");
const container22 = document.getElementById("container22");
const tryAgainBtnSuccess = document.getElementById("tryAgainBtnSuccess");
const tryAgainBtnFail = document.getElementById("tryAgainBtnFail");
const returnHomeBtnSuccess = document.getElementById("returnHomeBtnSuccess");
const returnHomeBtnFail = document.getElementById("returnHomeBtnFail");

let accrcyPercentage = 0;

let questions = [];
let correctIndex;
let currentQuestion;
let currentHeart;
let currentProgress;
let questionAmmount = 3;
let correctCount = 0;
let incorrectCount = 0;
let isSuccess = true;
let streak = false;
let streakCount = 0;
let maxStreak = 0;

backsoundAudio.volume = musicVolumeSlider.value / 100;
hoverSound.volume = sfxVolumeSlider.value / 100;

// Update volume musik ketika slider digeser
musicVolumeSlider.addEventListener("input", (event) => {
    alert(event.target.value / 100);
    backsoundAudio.volume = event.target.value / 100;
});

// Update volume SFX ketika slider digeser
sfxVolumeSlider.addEventListener("input", (event) => {
    hoverSound.volume = event.target.value / 100;
});

function PlayBacksoundAudio() {
    const duration = backsoundAudio.duration;

    if (duration > 0) {
        // Tentukan waktu mulai acak
        let randomStartTime = Math.random() * duration;
        backsoundAudio.currentTime = randomStartTime;
    }

    // Putar audio
    backsoundAudio.play().catch((error) => {
        console.error("Gagal memutar audio:", error);
    });
}

backsoundAudio.addEventListener("loadedmetadata", () => {
    PlayBacksoundAudio();
});

document.querySelectorAll(".option").forEach((option) => {
    option.addEventListener("mouseenter", () => {
        hoverSound.currentTime = 0.3;
        hoverSound.play();
    });
});

// Fungsi untuk memuat soal dan opsi
function LoadQuestion(currentQuestion) {
    // Placeholder untuk pengambilan soal dan jawaban dari database

    // Ambil soal dan opsi berdasarkan index currentQuestion
    const current = questions[currentQuestion];
    question.textContent = current.text;
    option_1.textContent = current.options[0];
    option_2.textContent = current.options[1];
    option_3.textContent = current.options[2];
    option_4.textContent = current.options[3];

    return current.correctIndex; // Mengembalikan indeks jawaban yang benar
}

// Fungsi untuk menampilkan menu
pauseBtn.addEventListener("click", () => {
    menuForm.style.display = "inline";
    menuBlur.style.display = "flex";
});

// Menutup menu saat mengklik blur
menuBlur.addEventListener("click", () => {
    menuForm.style.display = "none";
    menuBlur.style.display = "none";
    settingForm.style.display = "none";
});

restartBtn.addEventListener("click", () => {
    menuForm.style.display = "none";
    menuBlur.style.display = "none";
    StartQuiz();
    PlayBacksoundAudio();
});

returnHomeBtn.addEventListener("click", () => {
    // window.location.href = "{{ url('/') }}";
});

returnHomeBtnSuccess.addEventListener("click", () => {
    // window.location.href = "{{ url('/') }}";
});
returnHomeBtnFail.addEventListener("click", () => {
    // window.location.href = "{{ url('/') }}";
});

function resetDisplayScore() {
    // Atur ulang semua elemen tampilan skor ke keadaan awal
    successForm.style.display = "none";
    failForm.style.display = "none";
    gameOverMessage.style.fontSize = ""; // Reset font size
    gameOverMessage.style.top = ""; // Reset posisi
    accuracyDisplay.style.opacity = "0"; // Kembali ke awal
    accuracyPercentage.style.backgroundImage = ""; // Hapus perubahan gradien
    accuracyText.textContent = "0%"; // Reset teks ke awal

    // Reset statistik
    correctStat.textContent = "0";
    incorrectStat.textContent = "0";
    streakStat.textContent = "0";
    scoreStat.textContent = "0";

    // Reset kontainer
    statisticForm.style.opacity = "0";
    container2.style.opacity = "0";
}

tryAgainBtnSuccess.addEventListener("click", () => {
    StartQuiz();
    PlayBacksoundAudio();
    successForm.style.display = "none";
    resetDisplayScore();
});
tryAgainBtnFail.addEventListener("click", () => {
    StartQuiz();
    PlayBacksoundAudio();
    failForm.style.display = "none";
    resetDisplayScore();
});

settingBtn.addEventListener("click", () => {
    settingForm.style.display = "flex";
    menuForm.style.display = "none";
    menuBlur.style.display = "flex";
});

// Fungsi animasi saat jawaban salah
function animateHeartSplit() {
    fullHeart.classList.add("loseHeart");
    leftHeart.classList.add("split-left");
    rightHeart.classList.add("split-right");

    setTimeout(() => {
        leftHeart.style.transition = "none";
        rightHeart.style.transition = "none";
        leftHeart.classList.remove("split-left");
        rightHeart.classList.remove("split-right");
    }, 500);

    setTimeout(() => {
        leftHeart.style.transition = "all 0.5s ease-out";
        rightHeart.style.transition = "all 0.5s ease-out";
    }, 1000);

    setTimeout(() => {
        fullHeart.classList.remove("loseHeart");
    }, 1000);
}

function CalculateScore() {
    let baseScore = (correctCount / questionAmmount) * 100;
    console.log("Base Score: ", baseScore);

    let streakBonus = maxStreak * 2;
    console.log("Streak Bonus: ", streakBonus);

    accrcyPercentage = baseScore;
    console.log("Correct Percentage: ", accrcyPercentage);

    targetScore = baseScore + streakBonus;
    console.log("Total Score: ", targetScore);
}

function DisplayScore() {
    if (isSuccess) {
        successForm.style.display = "flex";
        setTimeout(() => {
            gameOverMessage.style.fontSize = "2rem";
            gameOverMessage.style.top = "60px";
        }, 1000);
        setTimeout(() => {
            accuracyDisplay.style.opacity = "100%";
        }, 1100);
        setTimeout(() => {
            let count = 0;
            const accChart = setInterval(() => {
                count += 1;
                accuracyPercentage.style.backgroundImage = `
                conic-gradient(
                    rgb(7, 177, 7) 0% ${count}%,
                    red ${count}% 100%
                    )
                    `;
                if (count >= accrcyPercentage) {
                    clearInterval(accChart);
                }
            }, 30);
            count = 0;
            const accValue = setInterval(() => {
                if (count >= accrcyPercentage) {
                    clearInterval(accValue); // Hentikan interval jika mencapai target
                } else {
                    count++;
                    accuracyText.textContent = count + "%"; // Update teks
                }
            }, 30);

            statisticForm.style.opacity = "100%";
        }, 1200);
        setTimeout(() => {
            let count = 0;
            const correctInterval = setInterval(() => {
                if (count >= correctCount) {
                    clearInterval(correctInterval); // Hentikan interval jika mencapai target
                } else {
                    count++;
                    correctStat.textContent = count; // Update teks
                }
            }, 30);
        }, 1300);
        setTimeout(() => {
            let count = 0;
            incorrectCount = questionAmmount - correctCount;
            const incorrectInterval = setInterval(() => {
                if (count >= incorrectCount) {
                    clearInterval(incorrectInterval); // Hentikan interval jika mencapai target
                } else {
                    count++;
                    incorrectStat.textContent = count; // Update teks
                }
            }, 30);
        }, 1400);
        setTimeout(() => {
            let count = 0;
            const streakInterval = setInterval(() => {
                if (count >= maxStreak) {
                    clearInterval(streakInterval); // Hentikan interval jika mencapai target
                } else {
                    count++;
                    streakStat.textContent = count; // Update teks
                }
            }, 30);
        }, 1500);
        setTimeout(() => {
            let count = 0;
            const scoreInterval = setInterval(() => {
                if (count >= targetScore) {
                    clearInterval(scoreInterval); // Hentikan interval jika mencapai target
                } else {
                    count++;
                    scoreStat.textContent = count; // Update teks
                }
            }, 30);
        }, 1600);
        setTimeout(() => {
            container2.style.opacity = "100%";
        }, 2500);
    } else {
        failForm.style.display = "flex";
        container22.style.opacity = "100%";
    }
    const userId = document
        .querySelector('meta[name="user-id"]')
        .getAttribute("content");
    const lastTake = new Date().toISOString();
    submitScore(targetScore, lastTake, userId);
}

function submitScore(score, lastTake, userId) {
    // Convert the datetime to MySQL format
    const formattedLastTake = new Date(lastTake)
        .toISOString()
        .slice(0, 19)
        .replace("T", " ");

    fetch("/score", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            score: score,
            last_take: formattedLastTake,
            user_id: userId,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Success:", data);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function PlayCorrectSound() {
    correctSound.currentTime = 0;
    correctSound.play();
}

function PlayinCorrectSound() {
    incorrectSound.currentTime = 0;
    incorrectSound.play();
}

// Fungsi untuk jawaban yang benar
function correctAns() {
    PlayCorrectSound();
    correctCount++;
    currentProgress += 100 / questionAmmount;
    progress.style.width = `${currentProgress}%`;

    if (streak) {
        streakCount++;
    } else {
        streak = true;
        streakCount = 1;
    }

    if (streakCount > maxStreak) {
        maxStreak = streakCount;
    }

    console.log("Streak Count: ", streakCount);
    // stopTimer();
}

// Fungsi untuk jawaban yang salah
function wrongAns() {
    PlayinCorrectSound();
    currentHeart--;
    heartAmmount.textContent = currentHeart;
    animateHeartSplit();

    if (streak) {
        streak = false;
        streakCount = 0;
    }

    console.log("Streak Count: ", streakCount);

    if (currentHeart < 1) {
        isSuccess = false;
        DisplayScore();
    }
}

// Fungsi untuk memeriksa jawaban yang dipilih
function CheckAnswer(event) {
    const clickedOption = event.target;
    if (clickedOption.classList.contains("option")) {
        const clickedIndex = parseInt(clickedOption.dataset.index, 10);

        currentQuestion++;
        console.log("Current Question:", currentQuestion); // Debug
        console.log("Question Ammount:", questionAmmount);
        const isCorrect = clickedIndex == correctIndex;
        isCorrect ? correctAns() : wrongAns();
        if (currentQuestion === questionAmmount) {
            CalculateScore();
            DisplayScore();
        } else {
            correctIndex = LoadQuestion(currentQuestion);
            console.log("Correct Index: ", correctIndex);
        }
    }
}

// Menambahkan event listener pada setiap opsi jawaban
function setUpOptions() {
    document.querySelectorAll(".option").forEach((option) => {
        option.addEventListener("click", CheckAnswer);
    });
}
// Fungsi untuk memulai kuis
function StartQuiz() {
    correctCount = 0;
    incorrectCount = 0;
    maxStreak = 0;
    streakCount = 0;
    isSuccess = true;
    streak = false;
    targetScore = 0;
    accrcyPercentage = 0;

    currentHeart = 5;
    currentProgress = 0;
    heartAmmount.textContent = currentHeart;
    progress.style.width = `${currentProgress}%`;
    currentQuestion = 0; // Indeks soal saat ini
    correctIndex = LoadQuestion(currentQuestion); // Memuat soal pertama dan mendapatkan indeks jawaban yang benar
    console.log("Correct Index: ", correctIndex);
    setUpOptions(); // Menyiapkan event listener untuk jawaban

    // Jika sudah sampai soal terakhir, tampilkan skor
    // if (currentQuestion == questions.length) {
    //   DisplayScore();
    // }
}

fetch("/api/questions")
    .then((response) => response.json())
    .then((data) => {
        data.forEach((question) => {
            questions.push(question);
            console.log(questions);
        });

        StartQuiz();
    })
    .catch((error) => console.error("Error:", error));
