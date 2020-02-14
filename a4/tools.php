<?php
  session_start();


  //provided functions (preShow printMyCode php2js)
  function preShow($arr, $returnAsString=false) {
    $ret = '<pre>' . print_r($arr, true) . '</pre>';
    if($returnAsString) {
      return $ret;
    }
    else {
      echo $ret;
    }
  }

  function printMyCode() {
    $lines = file($_SERVER['SCRIPT_FILENAME']);
    echo "<pre id='mycode'><ol>";
    foreach($lines as $line) {
      echo '<li>' . rtrim(htmlentities($line)) . '</li>';
    }
    echo '</ol></pre>';
  }

  function php2js($arr, $arrname) {
    echo "<script>\n";
    echo "/* Generated with A4's php2js() function */";
    echo "var $arrName = " . json_encode($arr, JSON_PRETTY_PRINT);
    echo "</script>\n\n";
  }
  //end of provided functions

  //associative arrays for movies and prices

  $moviesObject = [
    'ACT' => [
      'title' => 'Star Wars: The Rise of Skywalker',
      'rating' => 'M',
      'description' => '<p>The surviving Resistance faces the First Order once more in the final chapter of the Skywalker saga. Staring: Carrie Fisher, Mark Hamil, Adam Driver, Daisy Ridley, John Boyega, Oscar Issac Anthony Daniels and Naomi Ackie.</p>',
      'screenings' => [
         'Monday' => '12pm',
         'Tuesday' => '12pm',
         'Wednesday' => '6pm',
         'Thursday' => '6pm',
         'Friday' => '6pm',
         'Saturday' => '12pm',
         'Sunday' => '12pm'
       ]
    ],
    'RMC' => [
      'title' => 'The Aeronauts',
      'rating' => 'PG',
      'description' => '<p>Balloon pilot Amelia Wren and scientist James Glaisher find themselves in an epic fight for survival while attempting to make discoveries in a gas balloon in the 1860s.</p>',
      'screenings' => [
         'Monday' => '6pm',
         'Tuesday' => '6pm',
         'Saturday' => '3pm',
         'Sunday' => '3pm',
       ]
    ],
    'ANM' => [
      'title' => 'Frozen 2',
      'rating' => 'PG',
      'description' => '<p>From the Academy Award®-winning team—directors Jennifer Lee and Chris Buck, and producer Peter Del Vecho—and featuring the voices of Idina Menzel, Kristen Bell, Jonathan Groff and Josh Gad, and the music of Oscar®-winning songwriters Kristen Anderson-Lopez and Robert Lopez, Walt Disney Animation Studios’ “Frozen 2” opens in Australian cinemas November, 2019.</p>',
      'screenings' => [
         'Wednesday' => '9pm',
         'Thursday' => '9pm',
         'Friday' => '9pm',
         'Saturday' => '6pm',
         'Sunday' => '6pm'
       ]
    ],
    'AHF' => [
      'title' => 'JoJo Rabbit',
      'rating' => 'PG',
      'description' => '<p>A young boy in Hitler\'s army finds out his mother is hiding a Jewish girl in their home.</p>',
      'screenings' => [
         'Wednesday' => '12pm',
         'Thursday' => '12pm',
         'Friday' => '12pm',
         'Saturday' => '9pm',
         'Sunday' => '9pm'
       ]
    ]
  ];

  $pricesObject = [
    'MT' => [
      'STA' => '15.00',
      'STP' => '13.00',
      'STC' => '11.00',
      'FCA' => '25.00',
      'FCP' => '23.00',
      'FCC' => '21.00'
    ],
    'SS' => [
      'STA' => '20.50',
      'STP' => '18.00',
      'STC' => '15.50',
      'FTA' => '30.00',
      'FTP' => '27.50',
      'FTC' => '25.00'
    ]
  ];

  //function to print end content (mycode and post/session arrays)

  function endModule() {
    echo "<div id='debug' class='noprint'>";
    echo "<h3>Post</h3>";
    preShow($_POST);
    echo "<h3>Session</h3>";
    preShow($_SESSION);
    printMyCode();
    echo "</div>";
  }


  //adds previous post or session data to fields if they exist
  function addValue($id) {
    echo (isset($id)) ? htmlspecialchars($id) : '';
  }

  //FORM VALIDATION FUNCTIONS


  //global variables for form validation
  $hiddenErrors = 0;
  $custErrors = 0;      //these could be in an associative array - change if have time
  $seatsErrors = 0;
  $totalTickets = 0;
  $price = 0;
  $nameError = false;
  $emailError = false;   // these could also be in an associative array - also change if you have time 
  $mobileError = false;
  $cardError = false;
  $exipryError = false;


  //combine all validaton into one function
  function validateForm() {
    if(!empty($_POST)) { //check that post is not empty
      session_unset(); //reset the session for each time a ticket order is attempted - not 100% necessary but prevents some obscure bugs
      checkMovieData();
      checkCustData();
      checkSeatData();
      calculatePrice();
      writeTofile();
      generateReceipt();
    }
  }

  //function to enable the rerun of JS script
  function establishSyn(){
    if(!empty($_POST['synCode'])){
      echo "<script>swapSynopsis(" . $_POST['synCode']  . ")</script>";   //could not find a clean way to scroll to this when the input was wrong 
    }
  }
  
  //function to push data to the receipt page
  function generateReceipt(){
    global $hiddenErrors;
    global $custErrors;
    global $seatsErrors;
    global $totalTickets;
    if($hiddenErrors == 0 && $custErrors == 0 && $totalTickets > 0 && $seatsErrors == 0){
      $_SESSION += $_POST;
      header('Location: receipt.php');
    }
  }

  function generateTickets(){
    foreach($_SESSION['seats'] as $key => $value){
      if($value != 0){
        echo "<displayPage size='A4'>";
        echo tickePage();
        echo ticketGenerator($key);
        echo "</displayPage>";
      }
    }
  }

  //generates the ticket page to hold tickets for each ticket type
  function tickePage() {
    echo "<div class='header'>
            <div class='logocontainer'>
              <img src='../../media/Lunardo(200x200)2.png' alt='Lunardo Logo' height='95' class='logo'/> 
            </div>
            <div class='content'>
              <p class='address'>
                Address: 100 Film Street<br>
                Email: email@server.com<br>
                Phone: 12345678<br>
                ABN:  00 123 456 789<br>
              </p> 
            </div>
          </div>";
  }

  //generates individual tickets for each ticket type 
  //they are not the best looking but they are reasonable 
  function ticketGenerator($code){
    global $moviesObject;
    $totalTickets = $_SESSION['seats'][$code];;
    for($i = 0;$i<$totalTickets;$i++){
      echo "<div class='ticket'>
            <p class='ticketType'>" . $code . " ticket</p>";
      echo "<p>" . $_SESSION['cust']['name'] . "<br>";
      echo  $moviesObject[$_SESSION['movie']['id']]['title'] . " - " . $_SESSION['movie']['day'] . " - " . $_SESSION['movie']['hour'] . "</p>"; //this is ugly i know but limited time
      echo "<img src='../../media/Barcode.png' alt='Barcode' height='80' class='barcode'/>";
      echo "</div>";
    }
  }

  //function to calculate the price after all other data has been validated
  function calculatePrice() {
    global $totalTickets;
    global $pricesObject;
    global $price;
    global $hiddenErrors;
    if(!empty($_POST)) {   //recheck if post is empty (not necessaryily required but left in as insurance)
      if($totalTickets > 0 && $hiddenErrors == 0){
        foreach($_POST['seats'] as $seatCode => $qty) {   //dont need to check again if the array exits - this was done in the seat checking stage
          foreach($pricesObject[$_POST['seatPricing']] as $priceSeat => $val){
            if($seatCode == $priceSeat){
              $temp = $val*$qty;
              $price += $temp;
            }
          }
        }
        $_SESSION['price'] = $price;
      }
    }
  }  
  
  function writeToFile(){ //only occurs if the POST data is not empty
    global $hiddenErrors;
    global $custErrors;   
    global $totalTickets;   //again these could be in an array and be iterated over
    global $seatsErrors;
    global $price;
    if($hiddenErrors == 0 && $custErrors == 0 && $totalTickets > 0 && $seatsErrors == 0) {  //could maybe have a function to perform this check as its used multiple times
      $filename = "bookings.txt";                                                           //or maybe add a variable that does a true false check for all other checks
      $fp = fopen($filename,"a");
      flock($fp,LOCK_EX);
      $date = array(date("Y/m/d"));
      $modifiedCust = array();
      foreach($_POST['cust'] as $key => $value){
        if($key != 'card' && $key != 'expiry'){
          array_push($modifiedCust,$value);
        }
      }
      $finalArray = array_merge($date,$modifiedCust,$_POST['movie'],$_POST['seats']);
      array_push($finalArray,$price);
      fputcsv($fp,$finalArray,"\t");
      flock($fp,LOCK_UN);
      fclose($fp);
    }
  }
  
  
  //collect all movie data validation into one function
  function checkMovieData() {
    global $hiddenErrors;
    if(!empty($_POST['movie']['id']) && !empty($_POST['movie']['day']) && !empty($_POST['movie']['hour']) && !empty($_POST['seatPricing'])) { //ensure that all fields have some input
      if(!checkMovieCode()){
        $hiddenErrors++;
      }
      if(!checkMovieDay()) {
        $hiddenErrors++;
      }
      if(!checkMoviePricing()){    //check that the hidden field to decide the price of the ticket
        $hiddenErrors++;
      }
    }
    else {
      $hiddenErrors++;
    }
  }

  //combine all cust data validation into one function
  function checkCustData() {
    global $custErrors;
    global $nameError;
    global $emailError;
    global $mobileError;
    global $cardError;
    global $exipryError;
    if(!checkCustName()) {
      $custErrors++;
      $nameError = true;
    }
    if(!checkCustEmail()) {
      $custErrors++;
      $emailError = true;
    }
    if(!checkCustCard()) {
      $custErrors++;
      $cardError = true;
    }
    if(!checkCustMobile()){
      $custErrors++;
      $mobileError = true;
    }
    if(!checkCustexpiry()){
      $custErrors++;
      $exipryError = true;
    }
    
  }

  //collect all seat validation into one function
  function checkSeatData(){
    global $seatsErrors;
    global $totalTickets;
    global $pricesObject;
    if(isset($_POST['seats'])) { //maybe don't need this check
      if(!is_array($_POST['seats']) || !count($_POST['seats']>0)){
        $seatsErrors++;
      }
      else{
        foreach($_POST['seats'] as $seatCode => $qty) {
          if(!isset($pricesObject['MT'][$seatCode])) {
            $seatsErrors++;
          }
          else {
            if(!preg_match("#[0-9]$#",$qty)) {
              $seatsErrors++;
            }
            else {
              $totalTickets += $qty;
            }
          }
        }
      }
    }
  }

  function checkMovieCode() {
    global $moviesObject;
    $movieCodes = array_keys($moviesObject);
    $length = count($movieCodes);
    for ($i = 0; $i < $length; $i++){
      if ($_POST['movie']['id'] == $movieCodes[$i]) {
        return true;
      }
    }
    return false;
  }

  function checkMovieDay() {
    global $moviesObject;
    foreach ($moviesObject as $id => $idValue) {
      if($id == $_POST['movie']['id']) {
        foreach($idValue as $info => $infoValue) {           //is there a better way to do this - maybe with using array_keys of the internal Arrays
          if($info == 'screenings') {
            foreach($infoValue as $day => $dayValue) {
              if($day == $_POST['movie']['day']) {
                if($dayValue == $_POST['movie']['hour']){
                  return true;
                }                 //this can only be reached if the day and id are correct so you can check the time in the same check
                else {
                  return false;
                }
              }
            }
          }
        }
      }
    }
    return false;
  }

  function checkMoviePricing(){
    global $pricesObject;
    $priceCodes = array_keys($pricesObject);
    $length = count($priceCodes);
    for($i = 0;$i < $length; $i++){
      if($_POST['seatPricing'] == $priceCodes[$i]){
        return true;
      }
    }
    return false;
  }

  function checkCustName() {
    if(!empty($_POST['cust']['name'])) {
      $patt = "#^[a-z ,.'-]+ [a-z,.'-]+$#i";
      if(preg_match($patt, $_POST['cust']['name'])){
        return true;
      }
    }
    return false;
  }

  function checkCustEmail() {
    if(!empty($_POST['cust']['name'])) {
      $patt = "#^[^@]+@[^\.]+\..+$#";
      if(preg_match($patt,$_POST['cust']['email'])){
        return true;
      }
    }
    return false;
  }

  function checkCustMobile() {
    if(!empty($_POST['cust']['mobile'])) {
      $patt = "#^(\(04\)|04|\+614)( ?\d){8}$#";
      if(preg_match($patt,$_POST['cust']['mobile'])) {
        return true;
      }
    }
    return false;
  }

  function checkCustCard() {
    if(!empty($_POST['cust']['card'])) {
      $patt = "#^(\s?\d){14,19}$#";
      if(preg_match($patt,$_POST['cust']['card'])) {
        return true;
      }
    }
    return false;
  }

  function checkCustExpiry() {
    $expiry = $_POST['cust']['expiry'];
    if(!empty($expiry)) {
      $patt = "#^[12]\d{3}-(0[1-9]|1[0-2])$#";
      if(preg_match($patt,$expiry)) {
        $today = date("Y-m");
        if($expiry > $today) {
          return true;
        }
      }
    }
    return false;
  }

  //simple function to minimize typing (im lazy sometimes)
  function addFinalError() {
    echo "<script>document.getElementById('finalError').innerHTML = 'Ensure all the highlighted fields are correct'</script>";
  }

  function setupErrors() {
    global $nameError;
    global $emailError;
    global $mobileError;
    global $cardError;          // error values could be in an associative array and then iterate over it with a for loop looking for true values
    global $exipryError;        // however at the moment there is not time to redo this 
    global $hiddenErrors;
    global $seatsErrors;
    global $totalTickets;
    if(!empty($_POST)){
      establishSyn();
      if($nameError == true) {
        echo "<script>document.getElementById('cust[name]').classList.add('errorField')</script>";
        addFinalError();
      }
      if($emailError == true) {
        echo "<script>document.getElementById('cust[email]').classList.add('errorField')</script>";
        addFinalError();
      }
      if($mobileError == true) {
        echo "<script>document.getElementById('cust[mobile]').classList.add('errorField')</script>";
        addFinalError();
      }
      if($cardError == true) {
        echo "<script>document.getElementById('cust[card]').classList.add('errorField')</script>";
        addFinalError();
      }
      if($exipryError == true) {
        echo "<script>document.getElementById('cust[expiry]').classList.add('errorField')</script>";
        addFinalError();
        echo "<script>document.getElementById('expiryError').innerHTML = 'Date must be in the form YYYY-MM and be non-expired'</script>";
      }
      if($hiddenErrors != 0 || $seatsErrors != 0 || $totalTickets < 0){
        echo '<script>';
        echo ' alert("Stop Hacking our website please")';  
        echo '</script>';
      }
      
      if($totalTickets == 0){
        echo  "<script>document.getElementById('standardPrices-form').classList.add('ticketSet')</script>";
        echo  "<script>document.getElementById('firstClassPrices-form').classList.add('ticketSet')</script>";
        echo  "<script>document.getElementById('ticketError').innerHTML = 'Please select at least one ticket';</script>";
      }
    }
    establishSyn();
  }
  
?>