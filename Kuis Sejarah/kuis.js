// Elemen DOM
const backsoundAudio = document.getElementById('backsoundAudio');
const hoverSound = document.getElementById("hoverSound");
const correctSound = document.getElementById("correctSound");
const incorrectSound = document.getElementById("incorrectSound");

const pauseBtn = document.getElementById('pauseBtn');
const menuForm = document.getElementById('menuForm');
const menuBlur = document.getElementById('menuBlur');
const restartBtn = document.getElementById('restartBtn');
const returnHomeBtn = document.getElementById('returnHomeBtn');
const settingBtn = document.getElementById('settingBtn');
const settingForm = document.getElementById('settingForm');
const musicVolumeSlider = document.getElementById('musicVolume');
const sfxVolumeSlider = document.getElementById('sfxVolume');
const progress = document.getElementById('progress');

const leftHeart = document.getElementById('leftHeart');
const rightHeart = document.getElementById('rightHeart');
const fullHeart = document.getElementById('fullHeart');
const heartAmmount = document.getElementById('heartAmmount');

const question = document.getElementById('question');
const option_1 = document.getElementById('option-1');
const option_2 = document.getElementById('option-2');
const option_3 = document.getElementById('option-3');
const option_4 = document.getElementById('option-4');

const successForm = document.getElementById('successForm');
const failForm = document.getElementById('failForm');

let questions = [];
let correctIndex;
let currentQuestion;
let currentHeart;
let currentProgress;
let questionAmmount = 2;
let success = false;

backsoundAudio.volume = musicVolumeSlider.value / 100;
hoverSound.volume = sfxVolumeSlider.value / 100;

// Update volume musik ketika slider digeser
musicVolumeSlider.addEventListener('input', (event) => {
    alert(event.target.value / 100);
    backsoundAudio.volume = event.target.value / 100;
});
  
// Update volume SFX ketika slider digeser
sfxVolumeSlider.addEventListener('input', (event) => {
    hoverSound.volume = event.target.value / 100;
});

function PlayBacksoundAudio () {
    const duration = backsoundAudio.duration;

    if (duration > 0) {
        // Tentukan waktu mulai acak
        let randomStartTime = Math.random() * duration;
        backsoundAudio.currentTime = randomStartTime;
    }

    // Putar audio
    backsoundAudio.play().catch((error) => {
        console.error('Gagal memutar audio:', error);
    });
}

backsoundAudio.addEventListener('loadedmetadata', () => {
    PlayBacksoundAudio();
});

document.querySelectorAll(".option").forEach(option => {
    option.addEventListener("mouseenter", () => {
      hoverSound.currentTime = 0.3;
      hoverSound.play();
    });
});

questions.push({
    text: "Apa kepanjangan dari BPUPKI?",
    options: [
        "Badan Pembentukan Undang-Undang Dasar Kemerdekaan Indonesia",
        "Badan Penyelidik Usaha Persiapan Kemerdekaan Indonesia",
        "Badan Perencanaan Umum Persiapan Kemerdekaan Indonesia",
        "Badan Pembantu Upaya Proklamasi Kemerdekaan Indonesia"
    ],
    correctIndex: 2
});

questions.push({
    text: "Apa kepanjangan dari PPKI?",
    options: [
        "Panitia Pembentukan Kemerdekaan Indonesia",
        "Panitia Perencanaan Kemerdekaan Indonesia",
        "Panitia Persiapan Kemerdekaan Indonesia",
        "Panitia Pembantu Kemerdekaan Indonesia"
    ],
    correctIndex: 3
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
pauseBtn.addEventListener('click', () => {
    menuForm.style.display = "inline";
    menuBlur.style.display = "flex";
});

// Menutup menu saat mengklik blur
menuBlur.addEventListener('click', () => {
    menuForm.style.display = "none";
    menuBlur.style.display = "none";
    settingForm.style.display = "none";
});

restartBtn.addEventListener('click', () => {
    menuForm.style.display = "none";
    menuBlur.style.display = "none";
    StartQuiz();
    PlayBacksoundAudio();
});

returnHomeBtn.addEventListener('click', () => {
    window.location.href = 'home.html';
});

settingBtn.addEventListener('click', () => {
    settingForm.style.display = "flex";
    menuForm.style.display = "none";
    menuBlur.style.display = "flex";
});


// Fungsi animasi saat jawaban salah
function animateHeartSplit() {
    fullHeart.classList.add('loseHeart');
    leftHeart.classList.add('split-left');
    rightHeart.classList.add('split-right');

    setTimeout(() => {
        leftHeart.style.transition = 'none';
        rightHeart.style.transition = 'none';
        leftHeart.classList.remove('split-left');
        rightHeart.classList.remove('split-right');
    }, 500); 

    setTimeout(() => {
        leftHeart.style.transition = 'all 0.5s ease-out';
        rightHeart.style.transition = 'all 0.5s ease-out';
    }, 1000);

    setTimeout(() => {
        fullHeart.classList.remove('loseHeart');
    }, 1000);
}
function DisplayScore() {
    if(success){
        successForm.style.display = "flex";
    }else{
        failForm.style.display = "flex";
    }
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
    // alert('Correct!');
    
    // Pindah ke soal berikutnya
    currentQuestion++;
  
    // Jika sudah sampai soal terakhir, tampilkan skor dan durasi
    if (currentQuestion == questionAmmount) {
        PlayCorrectSound();
        currentProgress += 100 / questionAmmount;
        progress.style.width = `${currentProgress}%`;
        // stopTimer();
        success = true;
        DisplayScore(); // Tampilkan skor
    } else {
        PlayCorrectSound();
        correctIndex = LoadQuestion(currentQuestion); // Memuat soal selanjutnya
        currentProgress += 100 / questionAmmount;
        progress.style.width = `${currentProgress}%`;
    }
  }

// Fungsi untuk jawaban yang salah
function wrongAns() {
    PlayinCorrectSound();
    currentHeart--;
    heartAmmount.textContent = currentHeart;
    animateHeartSplit();
    if(currentHeart < 1){
        DisplayScore();
    }
}

// Fungsi untuk memeriksa jawaban yang dipilih
function CheckAnswer(event) {
  const clickedOption = event.target;
  if (clickedOption.classList.contains('option')) {
    const clickedIndex = parseInt(clickedOption.dataset.index, 10);

    const isCorrect = clickedIndex === correctIndex;
    isCorrect ? correctAns() : wrongAns();
  }
}

// Menambahkan event listener pada setiap opsi jawaban
function setUpOptions() {
  document.querySelectorAll('.option').forEach(option => {
    option.addEventListener('click', CheckAnswer);
  });
}
// Fungsi untuk memulai kuis
function StartQuiz() {
    currentHeart = 5;
    currentProgress = 0;
    heartAmmount.textContent = currentHeart;
    progress.style.width = `${currentProgress}%`;
    currentQuestion = 0; // Indeks soal saat ini
    correctIndex = LoadQuestion(currentQuestion); // Memuat soal pertama dan mendapatkan indeks jawaban yang benar
    setUpOptions(); // Menyiapkan event listener untuk jawaban
    
    // Jika sudah sampai soal terakhir, tampilkan skor
    // if (currentQuestion == questions.length) {
    //   DisplayScore();
    // }
}

// Panggil fungsi untuk memulai kuis
StartQuiz();
