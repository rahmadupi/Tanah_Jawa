var modal = document.getElementById("logout_modal");
var logout_button = document.getElementById("logout_button");
var cancel_button = document.getElementById("cancel_button");

logout_button.onclick = function () {
    modal.style.display = "block";
};

cancel_button.onclick = function () {
    modal.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

var currentIndex = 0;
var items = document.querySelectorAll(".carousel-item");
var indicators = document.querySelectorAll(".carousel-indicators button");

function showSlide(index) {
    items.forEach((item, i) => {
        item.style.transform = `translateX(-${index * 100}%)`;
        indicators[i].classList.toggle("active", i === index);
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % items.length;
    showSlide(currentIndex);
}

indicators.forEach((indicator, index) => {
    indicator.addEventListener("click", () => {
        currentIndex = index;
        showSlide(currentIndex);
    });
});

setInterval(nextSlide, 5000);
