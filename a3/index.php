<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed&display=swap" rel="stylesheet">
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <script src='../wireframe.js'></script>
  </head>

  <body>

    <header>
      <div>
        <img src='../../media/Lunardo(200x200)2.png' alt='Lunardo Logo' height="120"/> <!-- Logo made at https://www.freelogodesign.org/ -->
      </div>
    </header>

    <nav>
      <div class="nav-links">
        <a href="#about">
          About us
        </a>
        <a href="#price">
          Prices
        </a>
        <a href="#showing">
          Showing
        </a>
      </div>
    </nav>

    <main>
      <article class="us">
        <a name="about"></a>
        <h2>
            About Us 
        </h2>
        <div class="containingDiv">
          <div class="content">
          <p>
            Lunardo cinema is a small cinema business operating to provide current and trending films at affordable prices to our local community.
            We have recently reopened after a period of renovation to improve the quality of service we can provide. New standard and premium seating has been installed alongside new 3D Dolby Vision projection
            and Dolby Atmos sound. For more information about the new instalments visit: <a href="https://www.dolby.com/us/en/cinema" target="_blank"> Dolby Cinema </a>
          </p>
          </div>
        </div>
        <p>
            Below you can see the two styles of new seating that is being provided, standard and premium seating. These seats have been chosen so as to provide a more relaxing and comfortable viewing experience
            for our patrons. Standard seating come with ample comfort and space to ensure that the experience is of maximum satisfation. The premium seating provides additional support alongside the ability to 
            recline for the ultimate viewing experience. 
        </p>
        <div class="imageContainer">
          <img src="../../media/standard.png" id="standard" alt='Standard Seating'/>
          <img src="../../media/premium.png" id="premium" alt='Premium Seating'/>
        </div>
      </article>
      <h2>
        Prices
      </h2>  
      <article class="prices">
        <a name="price"></a>
        <div class="pricesGrid">
        <p>
          We at Lunardo strive to provide affordable pricing for all ages, as well as allowing for the additional selection of a premium service for those who wish to experience the viewing in maximum luxury.
        </p>
        <button  id="sButton" onclick="swapFunction(1)">Standard Ticket</button>
        <button  id="pButton" onclick="swapFunction(2)">Premium Ticket</button>
        <div id="tableDiv">
          <table id="Standard">
            <tr>
              <th>Seat Type</th>
              <th>All day Monday and Tuesday AND 12pm on Wednesday, Thursday and Friday.</th>
              <th>All day Saturday and Sunday and after 12pm on Wednesday, Thursday and Friday</th>
            </tr>
            <tr>
              <th>Adult</th>
              <th>15.00</th>
              <th>20.50</th>
            </tr>
            <tr>
              <th>Concession</th>
              <th>13.00</th>
              <th>18.00</th>
            </tr>
            <tr>
              <th>Child</th>
              <th>11.00</th>
              <th>15.50</th>
            </tr>
          </table>
        </div>
        <div id="Swap">
          <table id="Premium">
            <tr>
              <th>Seat Type</th>
              <th>All day Monday and Tuesday AND 12pm on Wednesday, Thursday and Friday.</th>
              <th>All day Saturday and Sunday and after 12pm on Wednesday, Thursday and Friday</th>
            </tr>
            <tr>
                <th>Adult</th>
                <th>25.00</th>
                <th>30.00</th>
              </tr>
              <tr>
                <th>Concession</th>
                <th>23.00</th>
                <th>27.50</th>
              </tr>
              <tr>
                <th>Child</th>
                <th>21.00</th>
                <th>25.00</th>
              </tr>
          </table>
         </div>
        </div>
      </article>
      <!--All poster images from their respective Imbd page-->
      <h2>
        Now Showing
      </h2>
      <article class="showing">
        <a name="showing"></a>
        <div class="ShowingOne">
          <img src='../../media/skywalker.png' alt='Star Wars: Rise of Skywalker (Poster)'/>
          <h3>
            Star Wars:The Rise of Skywalker
          </h3>
          <ul>
            <li>Monday - 12pm</li>
            <li>Tuesday - 12pm</li>
            <li>Wednesday - 6pm</li>
            <li>Thursday - 6pm</li>
            <li>Friday - 6pm</li>
            <li>Saturday - 12pm</li>
            <li>Sunday - 12pm</li>
          </ul>
        </div>
        <div class="ShowingTwo">
          <img src='../../media/Frozen2.jpg' alt='Frozen 2 (Poster)'/>
          <h3>
            Frozen 2
          </h3>
          <ul>
            <li>Monday    - N/A</li>
            <li>Tuesday   - N/A</li>
            <li>Wednesday - 9pm</li>
            <li>Thursday  - 9pm</li>
            <li>Friday    - 9pm</li>
            <li>Saturday  - 6pm</li>
            <li>Sunday    - 6pm</li>
          </ul>
        </div>
        <div class="ShowingThree">
          <img src='../../media/aeronauts.jpg' alt='The Aeronauts (Poster)'/>
          <h3>
            The Aeronauts
          </h3>
          <ul>
            <li>Monday - 6pm</li>
            <li>Tuesday - 6pm</li>
            <li>Wednesday - N/A</li>
            <li>Thursday - N/A</li>
            <li>Friday - N/A</li>
            <li>Saturday - 3pm</li>
            <li>Sunday - 3pm</li>
          </ul>
        </div>
        <div class="ShowingFour">
          <img src='../../media/JoJO.jpg' alt='JoJo Rabbit (Poster)'/>
          <h3>
            JoJo Rabbit
          </h3>
          <ul>
            <li>Monday - N/A</li>
            <li>Tuesday - N/A</li>
            <li>Wednesday - 12pm</li>
            <li>Thursday - 12pm</li>
            <li>Friday - 12pm</li>
            <li>Saturday - 9pm</li>
            <li>Sunday - 9pm</li>
          </ul>
        </div>
      </article>
      <article class="synopsis">
        <div class="synpanel">
          <h3>Star Wars: The Rise of Skywalker       M</h3>
          <p>The surviving Resistance faces the First Order once more in the final chapter of the Skywalker saga.
             Staring: Carrie Fisher, Mark Hamil, Adam Driver, Daisy Ridley, John Boyega, Oscar Issac Anthony Daniels and Naomi Ackie.
          </p>
          <!--Synopsis is copied form the hoyts synopsis of the film, found here https://www.hoyts.com.au/movies/star-wars-the-rise-of-skywalker-->
          <div class="video_container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/8Qn_spdM5Zg" frameborder="0" allowfullscreen></iframe>
          <!-- code for iframe copied from the youtube provided source, sharing and selecting embed on a youtube video provides a code snippet to imbed the video in the page-->
          </div>
          <div class="buttongroup">
            <button type="button">Monday - 12pm</button>
            <button type="button">Tuesday - 12pm</button>
            <button type="button">Wednesday - 6pm</button>
            <button type="button">Thursday - 6pm</button>
            <button type="button">Friday - 6pm</button>
            <button type="button">Saturday - 12pm</button>
            <button type="button">Sunday - 12pm</button>
          </div>
        </div>
      </article>
    </main>

    <footer>
      <div> Phone: 12345678 Email: email@server.com Address: 100 Film Street </div>
      <div>&copy;<script>
        document.write(new Date().getFullYear());
          var check = 1;
          function swapFunction(checkRecieve){
            
            if(check == checkRecieve) {

            }
            else {
            var x =  document.getElementById("tableDiv").innerHTML;
            document.getElementById("tableDiv").innerHTML =  document.getElementById("Swap").innerHTML;
            document.getElementById("Swap").innerHTML = x;
            check = checkRecieve;
            }
            
          }
      </script> Oliver Dunn Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
      <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
      
    </footer>

  </body>
</html>
