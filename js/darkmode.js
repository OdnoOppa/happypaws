
document.addEventListener("DOMContentLoaded", function () {
    
    function toggleDarkMode() {
        document.body.classList.toggle("dark-mode");
    }

   
    var darkModeButton = document.querySelector(".darkmode");

   
    darkModeButton.addEventListener("click", toggleDarkMode);
});