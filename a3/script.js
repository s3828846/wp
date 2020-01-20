/* Insert your javascript here */


window.onscroll = function() {
    console.log("Win Y: " +window.scrollY);
}

var check = 1;
function swapFunction(checkRecieve){  
    if(check != checkRecieve) {
        var x =  document.getElementById("tableDiv").innerHTML;
        document.getElementById("tableDiv").innerHTML =  document.getElementById("Swap").innerHTML;
        document.getElementById("Swap").innerHTML = x;
        check = checkRecieve;
    }           
}