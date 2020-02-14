<?php
    require_once("tools.php");

    if(empty($_SESSION['cust']) || empty($_SESSION['seats']) || empty($_SESSION['movie']) || empty($_SESSION['price'])){  //need to add the other fields for being empty
        header('Location: index.php');
    }

?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <title>Receipt for 
        <?php 
            isset($_SESSION['cust']['name']) ? addValue($_SESSION['cust']['name']) : "";
        ?>
    </title>
    <link id='stylecss' type="text/css" rel="stylesheet" href="receiptstyle.css?t=<?= filemtime("style.css"); ?>">
    <!--<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed&display=swap" rel="stylesheet">-->
  </head>
  <body>
    
    <header>
    </header>

    <nav>
    </nav>

    <main>
        <displayPage size="A4" id="invoice">
            <div class="header">
              <div class="logocontainer">
                <img src='../../media/Lunardo(200x200)2.png' alt='Lunardo Logo' height="120" class="logo"/> <!-- Logo made at https://www.freelogodesign.org/ -->
              </div>
              <div class="content">
                <p class="address">
                Address: 100 Film Street<br>
                Email: email@server.com<br>
                Phone: 12345678<br>
                ABN:  00 123 456 789<br>
                </p> 
              </div>
            </div>
            <div id=custinfo>
              <p>
              <?php
                foreach($_SESSION['cust'] as $key => $value){
                  if($key != 'card' && $key != 'expiry'){
                    echo $value;
                    echo "<br>";
                  }
                }
              ?>
              </p>
            </div>
            <div id=movieDetails>
              <p>
                <h3>Movie Details</h3>
                Movie: <?php addValue($_SESSION['movie']['id'])?><br>
                Time: <?php addValue($_SESSION['movie']['hour'])?><br>
                Day: <?php addValue($_SESSION['movie']['day'])?>
              </p> 
            </div>
            <div id=ticketSales>
              <h3 id=ticket> Tickets </h3>
              <p id=allTickets>
                <?php
                  foreach($_SESSION['seats'] as $key => $value){
                    if($value > 0){
                      echo $key . ": " . $value;
                      echo "<br>";
                    }
                  }
                ?>
              </p>
              <h3 id=price>Price</h3>
              <p id=gst>
                GST included: <?php
                          echo "$" . number_format($_SESSION['price']/11,2);
                          echo "<br>";
                          ?>
                Total Price: <?php
                              echo "$" . number_format($_SESSION['price'],2);
                              echo "<br>";
                            ?>
              </p>  
            </div>
        </displayPage>
        <?php
          generateTickets();
        ?>
    </main>
    

    <footer>
      <script src="script.js"> </script> <!--Script source for site-->
    </footer>
    
  </body>
</html>

<?php
  endModule();
?>
