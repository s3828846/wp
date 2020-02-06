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

  if(isset($_POST['session-reset'])) {
    foreach($_Session as $something => &$whatever) {
      unset($whatever);
    }
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
    'full' => [
      'STA' => '19.8'

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

  //form validation functions


  //global variables for form validation
  $hiddenErrors = 0;
  $custErrors = 0;    
  $totaltickets = 0;


  //combine all validaton into one function
  function validateForm() {
    global $moviesObject;
    $test = array_column($moviesObject, 'Monday');
    print_r($test);
    //checkMovieData();
  }
  
  
  //collect all movie data validation into one function
  function checkMovieData() {
    global $hiddenErrors;
    if(!checkMovieCode()){
      $hiddenErrors++;
    }
    if(!checkMovieDay()) {
      $hiddenErrors++;
    }
  }

  //combine all cust data validation into one function
  function checkCustData() {

  }

  function checkMovieCode() {
    global $moviesObject;
    if(isset($_POST['movie']['id'])) {
      $movieCodes = array_keys($moviesObject);
      $length = count($movieCodes);
      for ($i = 0; $i < $length; $i++){
        if ($_POST['movie']['id'] == $movieCodes[$i]) {
          return true;
        }
      }
      return false;
    }
    return true;
  }

  function checkMovieDay() {
    global $moviesObject;
    if(isset($_POST['movie']['day'])) {
      $currentMovie = $_POST['movie']['day'];
      $moviesDays = array_keys($moviesObject, 'screenings[$currentMovie]');
      $length = count($movieDays);
      for($i=0;$i<$length;$i++){
        if($_POST['movie']['day'] == $movieDays[$i]) {
          return true;
        }
      }
      return false;
    }
    return true;
  }

  function clearAllErrors() {

  }

  function checkName() {

  }
  
?>