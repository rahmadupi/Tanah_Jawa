const pauseBtn = document.getElementById('pauseBtn');
const menuForm = document.getElementById('menuForm');
const menuBlur = document.getElementById('menuBlur');

const leftHeart = document.getElementById('leftHeart');
const rightHeart = document.getElementById('rightHeart');
const fullHeart = document.getElementById('fullHeart');

pauseBtn.addEventListener('click', function(){
    menuForm.style.display = "inline";
    menuBlur.style.display = "flex";
});

menuBlur.addEventListener('click', function(){
    menuForm.style.display = "none";
    menuBlur.style.display = "none";
});

// Fungsi untuk memulai animasi hati pecah
function animateHeartSplit() {
    
    // Tambahkan kelas animasi
    fullHeart.classList.add('loseHeart');
    leftHeart.classList.add('split-left');
    rightHeart.classList.add('split-right');
  
    // Opsional: Reset animasi setelah selesai (contoh 2 detik)
    setTimeout(() => {
        leftHeart.style.transition = 'none';
        rightHeart.style.transition = 'none';
    
        // Hapus kelas animasi
        leftHeart.classList.remove('split-left');
        rightHeart.classList.remove('split-right');
    }, 500); // Waktu sama dengan durasi animasi di CSS
    setTimeout(() => {
        leftHeart.style.transition = 'all 0.5s ease-out';
        rightHeart.style.transition = 'all 0.5s ease-out';
    }, 1000);
    setTimeout(() => {
        fullHeart.classList.remove('loseHeart');
    }, 1000);
  }
  
  // Event listener untuk tombol trigger
  document.getElementById('option-1').addEventListener('click', animateHeartSplit);
  