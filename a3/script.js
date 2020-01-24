/* Insert your javascript here */

/*var movieObject = {
    ACT: {
        Mon:    "Star Wars: The Rise of Skywalker - Monday - 12pm",
        Tue:    "Star Wars: The Rise of Skywalker - Tuesday - 12pm",
        Wed:    "Star Wars: The Rise of Skywalker - Wednesday - 6pm",
        Thu:    "Star Wars: The Rise of Skywalker - Thursday - 6pm",
        Fri:    "Star Wars: The Rise of Skywalker - Friday - 6pm",
        Sat:    "Star Wars: The Rise of Skywalker - Saturday - 12pm",
        Sun:    "Star Wars: The Rise of Skywalker - Sunday - 12pm"
    },
    ANM: {
        Wed: "Frozen 2 - Wednesday - 9pm",
        Thu: "Frozen 2 - Thursday - 9pm",
        Fri: "Frozen 2 - Friday - 9pm",
        Sat: "Frozen 2 - Saturday - 6pm",
        Sun: "Frozen 2 - Sunday - 6pm"
    },
    RMC: {
        Mon: "The Aeronauts - Monday - 6pm",
        Tue: "The Aeronauts - Tuesday - 6pm",
        Sat: "The Aeronauts - Saturday - 3pm",
        Sun: "The Aeronauts - Sunday - 3pm",
    },
    AHF: {
        Wed: "JoJo Rabbit - Wednesday - 12pm",
        Thu: "JoJo Rabbit - Thursday - 12pm",
        Fri: "JoJo Rabbit - Friday - 12pm",
        Sat: "JoJo Rabbit - Saturday - 9pm",
        Wed: "JoJo Rabbit - Sunday - 9pm",
    }
}*/

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

var STA;
var STP;
var STC;
var FCA;
var FCP;
var FCC;
var totalPrice;



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

function movieAssignment(title,day,hour,type,priceGuide) {
    document.getElementById("movie[id]").value = type;
    document.getElementById("movie[hour]").value = hour;
    document.getElementById("movie[day]").value = day;
    document.getElementById("movieInfo").innerHTML = title + " " + day + " " + hour;
    document.getElementById("booking-form").style.display = "block";
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
    document.getElementById("price").innerHTML = fixedPrice;
}

var totalErrors = 0;
var totalTickets = 0;

function clearError(){
    var errors = document.getElementsByClassName("error");
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
        totalErrors++;
        document.getElementById("nameError").innerHTML = "<br>Please input a valid name";
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
        totalErrors++;
        document.getElementById("telError").innerHTML = "<br>Please input a valid mobile number";
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
        
        totalErrors++;
        document.getElementById("cardError").innerHTML = "<br>Please input a valid card";
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
        totalErrors++;
        document.getElementById("emailError").innerHTML = "<br>Please input a valid email";
        return false;
    }
}

function checkMonth() {
    var patt = /^[12]\d{3}-(0[1-9]|1[0-2])$/;
    var fromForm = document.getElementById("cust[expiry]").value
    var d = new Date();
    var current = new Date(d.getFullYear(),d.getMonth());
    var sup = new Date(fromForm);
    var altered = new Date(sup.getFullYear(),sup.getMonth());
    if(patt.test(fromForm)){
        if(altered.getTime() <= current.getTime()){
            document.getElementById("expiryError").innerHTML = "<br>The input date has expired"
            totalErrors++;
            return false;
        }
        else {
            return true;
        }
    }
    else {
        document.getElementById("expiryError").innerHTML = "<br>Please input a valid date in the format YYYY-MM";
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
        document.getElementById("ticketError").innerHTML = "<br>Please select at least one ticket";
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