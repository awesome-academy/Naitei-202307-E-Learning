let isPressed = true;
document.getElementById("drop-down-btn").onclick = function() {myFunction()};

function myFunction() {
    if(isPressed){
        document.getElementById("drop-down").classList.remove("hidden");
        isPressed = false;
    }
    else{
        document.getElementById("drop-down").classList.add("hidden");
        isPressed = true;
    }
}
