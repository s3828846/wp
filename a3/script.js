/* Insert your javascript here */


window.onscroll = function() {
    //console.clear();
    //console.log("Win Y: " +window.scrollY);
    var navlinks = document.getElementsByTagName("nav")[0].getElementsByTagName("a");
    var articles = document.getElementsByTagName("main")[0].getElementsByTagName("article");
    for(var i = 0;i<articles.length;i++) {
        var articleTop = articles[i].offsetTop-1;
        var articleBot = articles[i].offsetTop+articles[i].offsetHeight;
        //console.log(articleTop+" "+articleBot);
        if (window.scrollY >= articleTop && window.scrollY < articleBot) {
            //console.log(articles[i].className+": current")
            navlinks[i].classList.add("current");
        } else {
            //console.log(articles[i]+":");
            navlinks[i].classList.remove("current");
        }
    }
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
var currentSyn;
function swapSynopsis(recieved) {
    var container = document.getElementById("synContiner");
    var temp;
    switch(recieved){
        case 1:
            //temp = container.innerHTML;
            container.innerHTML = document.getElementById("synopsisACT").innerHTML;
            break;
        case 2:
            container.innerHTML = document.getElementById("synopsisANM").innerHTML;
            break;
        case 3:
            container.innerHTML = document.getElementById("synopsisRMC").innerHTML;
            break;
        case 4:
            container.innerHTML = document.getElementById("synopsisAHF").innerHTML;
            break;
    }
}