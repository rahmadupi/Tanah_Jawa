window.onclick = function (event) {
    if (
        outer_modal.style.display === "block" &&
        modal.style.display === "block"
    ) {
        outer_modal.classList.remove("fade-in");
        modal.classList.remove("scale-in");
        outer_modal.classList.add("fade-out");
        modal.classList.add("scale-out");
        setTimeout(() => {
            modal.style.display = "none";
            outer_modal.style.display = "none";
        }, 100);
    }
};

var modal = document.getElementById("logout_modal");
var outer_modal = document.getElementById("modal-parrent");
var logout_button = document.getElementById("logout_button");
var cancel_button = document.getElementById("cancel_button");

if (logout_button) {
    console.log("logout_button found");
    logout_button.onclick = function () {
        setTimeout(() => {
            outer_modal.style.display = "block";
            modal.style.display = "block";
            outer_modal.classList.add("fade-in");
            modal.classList.add("scale-in");
            modal.classList.remove("scale-out");
            outer_modal.classList.remove("fade-out");
        }, 100);
    };
}

if (cancel_button) {
    cancel_button.onclick = function () {
        outer_modal.classList.remove("fade-in");
        modal.classList.remove("scale-in");
        outer_modal.classList.add("fade-out");
        modal.classList.add("scale-out");
        setTimeout(() => {
            modal.style.display = "none";
            outer_modal.style.display = "none";
        }, 100);
    };
}

// var currentIndex = 0;
// var items = document.querySelectorAll(".carousel-item");
// var indicators = document.querySelectorAll(".carousel-indicators button");

// function showSlide(index) {
//     items.forEach((item, i) => {
//         item.style.transform = `translateX(-${index * 100}%)`;
//         indicators[i].classList.toggle("active", i === index);
//     });
// }

// function nextSlide() {
//     currentIndex = (currentIndex + 1) % items.length;
//     showSlide(currentIndex);
// }

// indicators.forEach((indicator, index) => {
//     indicator.addEventListener("click", () => {
//         currentIndex = index;
//         showSlide(currentIndex);
//     });
// });
// setInterval(nextSlide, 5000);

// document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
//     anchor.addEventListener("click", function (e) {
//         e.preventDefault();
//         const targetId = this.getAttribute("href").substring(1);
//         const targetElement = document.getElementById(targetId);

//         if (targetElement) {
//             targetElement.scrollIntoView({
//                 behavior: "smooth",
//                 block: "start",
//             });
//         }
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll('a[href^="#"]');
    const logo = document.getElementById("logo");

    for (const link of links) {
        console.log("Adding event listener to link:", link);
        link.addEventListener("click", function (event) {
            event.preventDefault();
            console.log("Link clicked:", this);

            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                console.log("Scrolling to element:", targetElement);
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: "smooth",
                });
            } else {
                console.log("Target element not found:", targetId);
            }
        });
    }

    if (logo) {
        console.log("Adding event listener to logo:", logo);
        logo.addEventListener("click", function (event) {
            event.preventDefault();
            console.log("Logo clicked");
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
            window.location.hash = "#";
        });
    }
});
