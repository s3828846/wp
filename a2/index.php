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
        <p>
          Lunardo cinema is a small cinema business operating to provide current and trending films at affordable prices to our local community.
        </p>
        <p>
          We have recently reopened after a period of renovation to improve the quality of service we can provide. New standard and premium seating has been installed alongside new 3D Dolby Vision projection
          and Dolby Atmos sound. For more information about the new instalments visit: <a href="https://www.dolby.com/us/en/cinema" target="_blank"> Dolby Cinema </a>
        </p>
      </article>
      <article class="prices">
        <a name="price"></a>
        <h2>
        Prices
        </h2>  
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
      </script> Oliver Dunn Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
      <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
    </footer>

  </body>
</html>
