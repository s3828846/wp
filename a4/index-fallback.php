<!-- 
  To be used only in an emergency, ie
  when your A3 index.php page is broken 
-->
<!--testing php code here -->

<?php
  require_once("tools.php");
  validateForm();
?>



<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <title>A4 Backup Page</title>
    <style>label { display: inline-block; width:90px; }</style>
    <link id='stylebackup' type="text/css" rel="stylesheet" href="stylebackup.css?t=<?= filemtime("stylebackup.css"); ?>">
  </head>

  <body>
    
    <header>
      <h1>🌕 Lunardo Cinema</h1>
    </header>

    <nav>
    </nav>

    <main>
      <h2>A4 Booking Form</h2>
      <form method='post' action='index-fallback.php'>
        <label>MovieId</label><input type=text name='movie[id]'/><br>
        <label>MovieDay</label><input type=text name='movie[day]'/><br>
        <label>MovieHour</label><input type=text name='movie[hour]'/><br>
        <label>DiscountOrNot</label><input type=text name='seatPricing'/><br>
        <br>
        <label>SeatsSTA</label><input type=text name='seats[STA]'/><br>
        <label>SeatsSTP</label><input type=text name='seats[STP]'/><br>
        <label>SeatsSTC</label><input type=text name='seats[STC]'/><br>
        <label>SeatsFCA</label><input type=text name='seats[FCA]'/><br>
        <label>SeatsFCP</label><input type=text name='seats[FCP]'/><br>
        <label>SeatsFCC</label><input type=text name='seats[FCC]'/><br>
        <br>
        <label>CustName</label><input type=text name='cust[name]' id='cust[name]' placeholder="First Last" 
        value="<?php
                  isset($_POST['cust']['name']) ? addValue($_POST['cust']['name']) : "";
              ?>"
        /><br>
        <label>CustEmail</label><input type=text name='cust[email]' id='cust[email]' placeholder="example@server.com"  
        value="<?php
                  isset($_POST['cust']['email']) ? addValue($_POST['cust']['email']) : "";
              ?>"/><br>
        <label>CustMobile</label><input type=text name='cust[mobile]' id='cust[mobile]' placeholder="123" 
        value="<?php
                  isset($_POST['cust']['mobile']) ? addValue($_POST['cust']['mobile']) : "";
              ?>"/><br>
        <label>CustCard</label><input type=text name='cust[card]' id='cust[card]' placeholder="card" 
        value="<?php
                  isset($_POST['cust']['card']) ? addValue($_POST['cust']['card']) : "";
              ?>"/><br>
        <label>CustExpiry</label><input type=month name='cust[expiry]' id='cust[expiry]' placeholder="ex" 
        value="<?php
                  isset($_POST['cust']['expiry']) ? addValue($_POST['cust']['expiry']) : "";
              ?>"/><br>
        <input type=submit value='Book'/>
      </form>
    </main>

    <footer>
    </footer>
    
  </body>
</html>

<?php
  //endModule();
  //setupErrors();
?>
