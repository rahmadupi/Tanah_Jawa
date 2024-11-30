document
  .getElementById("usernameButton")
  .addEventListener("click", function () {
    var dropdown = document.getElementById("dropdown");
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
  });
