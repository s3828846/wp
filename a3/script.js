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
    document.getElementById("synFrame").style.display = "block";
    container.scrollIntoView();
    switch(recieved){
        case 1:
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

function movieAssignment(title,day,hour,type) {
    document.getElementById("movie[id]").value = type;
    document.getElementById("movie[hour]").value = hour;
    document.getElementById("movie[day]").value = day;
    document.getElementById("movieInfo").innerHTML = title + " " + day + " " + hour;
    document.getElementById("booking-form").style.display = "block";
    var movieOrder = document.getElementById("booking-form").scrollIntoView(true)
}

function clearError(){
    var errors = document.getElementsByClassName("error");
    for(var i = 0;i<errors.length;i++){
        errors[i].innerHTML = "";
    }
}

function checkName() {
    var name = document.getElementById("cust[name]").value;
    var patt = /^[A-Za-z\-\' ]+$/;
    if(patt.test(name)) {
        console.log("true");
        return true;  
    }
    else {
        console.log("false");
        return false;
        
    }
}

function formCheck() {
    checkName();
    return (false);
}