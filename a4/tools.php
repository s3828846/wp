<?php
  session_start();
  //provided functions (preShow printMyCode php2js session reset)

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
      'FTA' => '25.00',
      'FTP' => '23.00',
      'FTC' => '21.00'
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
    echo "<div id='debug'>";
    echo "<h3>Post</h3>";
    preShow($_POST);
    echo "<h3>Session</h3>";
    preShow($_SESSION);
    printMyCode();
    echo "</div>";
  }

  //FORM VALIDATION FUNCTIONS


  //global variables for form validation
  $hiddenErrors = 0;
  $custErrors = 0;    
  $totaltickets = 0;
  $nameError = false;
  $emailError = false;
  $mobileError = false;
  $cardError = false;
  $exipryError = false;


  //combine all validaton into one function
  function validateForm() {
    preShow($_POST);
    if(!empty($_POST)) { //check that post is not empty
      checkMovieData();
      checkCustData();
      checkSeatData();
    }
  }
  
  
  
  //collect all movie data validation into one function
  function checkMovieData() {
    global $hiddenErrors;
    if(!empty($_POST['movie']['id']) && !empty($_POST['movie']['day']) && !empty($_POST['movie']['hour'])) { //ensure that all fields have some input
      if(!checkMovieCode()){
        $hiddenErrors++;
      }
      if(!checkMovieDay()) {
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
    if(isset($_POST['seats'])) {
      if(!is_array($_POST['seats']) || !count($_POST['seats']>0)){

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

  function setupErrors() {
    global $nameError;
    global $emailError;
    global $mobileError;
    global $cardError;
    global $exipryError;
    global $hiddenErrors;
    if($nameError == true) {
      echo "<script>document.getElementById('cust[name]').classList.add('errorField')</script>";
    }
    if($emailError == true) {
      echo "<script>document.getElementById('cust[email]').classList.add('errorField')</script>";
    }
    if($mobileError == true) {
      echo "<script>document.getElementById('cust[mobile]').classList.add('errorField')</script>";
    }
    if($cardError == true) {
      echo "<script>document.getElementById('cust[card]').classList.add('errorField')</script>";
    }
    if($exipryError == true) {
      echo "<script>document.getElementById('cust[expiry]').classList.add('errorField')</script>";
    }
    if($hiddenErrors != 0){
      echo '<script>';
      echo ' alert("Stop Hacking our website please")';  
      echo '</script>';
    }

  }
  
?>