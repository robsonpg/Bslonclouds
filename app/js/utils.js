//###############################################################
// Sacode
function shakeDOM(element) {
    // verifica o tipo do elemento
    //var type = element.nodeName;

    if ((element.value === '') || (element.value === null)) {
        //alert("animation!");
        element.focus();
        element.style.borderColor = "red";
        element.className = "shake";
        element.addEventListener("webkitAnimationEnd", function endEdit() {
            element.style.borderColor = "#A9A9A9";
            element.className = "";
        });

        return false;
    }
    return true;
}