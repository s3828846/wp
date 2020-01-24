//global variables
var STA;
var STP;
var STC;
var FCA;
var FCP;
var FCC;
var totalPrice;
var check = 1;

var priceObject = {
    Std: {
        One: {
            adu: "15.00",
            con: "13.00",
            chi: "11.00"
        },
        Two: {
            adu: "20.50",
            con: "18.00",
            chi: "15.50"
        }
    },
    Pre: {
        One: {
            adu: "25.00",
            con: "23.00",
            chi: "21.00"
        },
        Two: {
            adu: "30.00",
            con: "27.50",
            chi: "25.00"
        }
    }
}

window.onscroll = function() {
    var navlinks = document.getElementsByTagName("nav")[0].getElementsByTagName("a");
    var articles = document.getElementsByTagName("main")[0].getElementsByTagName("article");
    for(var i = 0;i<articles.length;i++) {
        var articleTop = articles[i].offsetTop-20;
        var articleBot = articles[i].offsetTop+articles[i].offsetHeight;
        if (window.scrollY >= articleTop && window.scrollY < articleBot) {
            navlinks[i].classList.add("current");
        } else {
            navlinks[i].classList.remove("current");
        }
    }
}


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

function movieAssignment(title,day,hour,type,priceGuide) {
    document.getElementById("movie[id]").value = type;
    document.getElementById("movie[hour]").value = hour;
    document.getElementById("movie[day]").value = day;
    document.getElementById("movieInfo").innerHTML = title + " " + day + " " + hour;
    document.getElementById("booking-form").style.display = "grid";
    document.getElementById("cust[expiry]").min = new Date();
    setPrice(priceGuide);
    updatePrice()
    var movieOrder = document.getElementById("booking-form").scrollIntoView(true)
}

function setPrice(priceGuide){
    totalPrice = 0;
    if(priceGuide == 1){
        STA = priceObject["Std"]["One"]["adu"];
        STP = priceObject["Std"]["One"]["con"];
        STC = priceObject["Std"]["One"]["chi"];
        FCA = priceObject["Pre"]["One"]["adu"];
        FCP = priceObject["Pre"]["One"]["con"];
        FCC = priceObject["Pre"]["One"]["chi"];
    }
    if(priceGuide == 2){
        STA = priceObject["Std"]["Two"]["adu"];
        STP = priceObject["Std"]["Two"]["con"];
        STC = priceObject["Std"]["Two"]["chi"];
        FCA = priceObject["Pre"]["Two"]["adu"];
        FCP = priceObject["Pre"]["Two"]["con"];
        FCC = priceObject["Pre"]["Two"]["chi"];
    }
}

function updatePrice(){
    var fixedPrice;
    totalPrice = 0;
    totalPrice += (document.getElementById("seats[STA]").value * STA);
    totalPrice += (document.getElementById("seats[STP]").value * STP);
    totalPrice += (document.getElementById("seats[STC]").value * STC);
    totalPrice += (document.getElementById("seats[FCA]").value * FCA);
    totalPrice += (document.getElementById("seats[FCP]").value * FCP);
    totalPrice += (document.getElementById("seats[FCC]").value * FCC);
    fixedPrice = totalPrice.toFixed(2);
    document.getElementById("orderPrice").innerHTML = "$ " + fixedPrice;
}

var totalErrors = 0;
var totalTickets = 0;

function clearError(){
    var errors = document.getElementsByClassName("error");
    document.getElementById("standardPrices-form").classList.remove("ticketSet");
    document.getElementById("firstClassPrices-form").classList.remove("ticketSet");
    document.getElementById("cust[name]").classList.remove("errorField");
    document.getElementById("cust[email]").classList.remove("errorField");
    document.getElementById("cust[card]").classList.remove("errorField");
    document.getElementById("cust[expiry]").classList.remove("errorField");
    document.getElementById("cust[mobile]").classList.remove("errorField");
    for(var i = 0;i<errors.length;i++){
        errors[i].innerHTML = "";
    }
    totalErrors = 0;
    totalTickets = 0; 
}

function checkName() {
    var name = document.getElementById("cust[name]").value;
    var patt = /^[a-z ,.'-]+ [a-z,.'-]+$/i;
    if(patt.test(name)) {
        return true;  
    }
    else {
        document.getElementById("finalError").innerHTML = "Ensure all fields are Correct"
        document.getElementById("cust[name]").classList.add("errorField");
        totalErrors++;
        return false;
        
    }
}

function checkMobile() {
    var mobile = document.getElementById("cust[mobile]").value;
    var patt = /^(\(04\)|04|\+614)( ?\d){8}$/;
    if(patt.test(mobile)) {
        return true;
    }
    else {
        document.getElementById("finalError").innerHTML = "Ensure all fields are Correct"
        document.getElementById("cust[mobile]").classList.add("errorField");
        totalErrors++;
        return false;
    }
}

function checkCard() {
    var card = document.getElementById("cust[card]").value;
    var patt = /^(\s?\d){14,19}$/
    if(patt.test(card)) {
        return true;
    }
    else {
        document.getElementById("finalError").innerHTML = "Ensure all fields are Correct"
        document.getElementById("cust[card]").classList.add("errorField");
        totalErrors++;
        return false;
    }
}



function checkMail() {
    var email = document.getElementById("cust[email]").value;
    var patt = /^[^@]+@[^\.]+\..+$/; 
    if(patt.test(email)) {
        return true;
    }
    else {
        document.getElementById("finalError").innerHTML = "Ensure all fields are Correct"
        document.getElementById("cust[email]").classList.add("errorField");
        totalErrors++;
        return false;
    }
}

function checkMonth() {
    var patt = /^[12]\d{3}-(0[1-9]|1[0-2])$/;
    var fromForm = document.getElementById("cust[expiry]").value
    var d = new Date();
    var current = new Date(d.getFullYear(),d.getMonth());
    var sup = new Date(fromForm);
    var altered = new Date(sup.getFullYear(),sup.getMonth());  //alterted supplied date to ensure that the time of the submitted date does not effect the comparison
    if(patt.test(fromForm)){
        if(altered.getTime() <= current.getTime()){
            document.getElementById("expiryError").innerHTML = "The input date has expired"
            document.getElementById("cust[expiry]").classList.add("errorField");
            totalErrors++;
            return false;
        }
        else {
            return true;
        }
    }
    else {
        document.getElementById("expiryError").innerHTML = "Input date in the form YYYY-MM";
        document.getElementById("cust[expiry]").classList.add("errorField");
        totalErrors++;
        return false;
    }
}

function checkTickets() {
    totalTickets += document.getElementById("seats[STA]").value;
    totalTickets += document.getElementById("seats[STP]").value;
    totalTickets += document.getElementById("seats[STC]").value;
    totalTickets += document.getElementById("seats[FCA]").value;
    totalTickets += document.getElementById("seats[FCP]").value;
    totalTickets += document.getElementById("seats[FCC]").value;
    if(totalTickets<=0)
    {
        document.getElementById("ticketError").innerHTML = "Please select at least one ticket";
        document.getElementById("standardPrices-form").classList.add("ticketSet");
        document.getElementById("firstClassPrices-form").classList.add("ticketSet");
        totalErrors++;
        return false;
    }
    else {
        return true;
    }
}

function formCheck() {
    clearError();
    checkName();
    checkMobile();
    checkCard();
    checkMail();
    checkMonth();
    checkTickets();
    return(totalErrors==0);
}