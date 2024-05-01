
var input_bar = document.getElementById("inputBar");
var main_button = document.getElementById("mainBtn");

window.addEventListener("keydown", event => {
    
    // Shortcut for search bar / input bar
    if (event.ctrlKey && event.key == "/") input_bar.focus();

    // shortcut for enter 
    if (event.key == "Enter") main_button.click();

});