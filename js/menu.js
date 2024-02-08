document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("userBtn").addEventListener("click", function() {
        var menu = document.getElementById("menu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    });
});
