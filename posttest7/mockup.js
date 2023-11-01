let element = document.getElementById("darkmode");
let body = document.getElementById("dark-mode-active");
element.addEventListener("click", () => {
   body.classList.toggle("dark-mode");
});