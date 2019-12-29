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
        <img src='../../media/Lunardo(200x200)2.png' alt='Lunardo Logo'/> <!-- Logo made at https://www.freelogodesign.org/ -->
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
      <article class="showing">
        <a name="showing"></a>
        <h2>
          Now Showing
        </h2>
      </article>
    </main>

    <footer>
      <div> Phone: 12345678 Email: email@server.com Address: 100 Movie Street </div>
      <div>&copy;<script>
        document.write(new Date().getFullYear());
      </script> Oliver Dunn Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
      <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
    </footer>

  </body>
</html>
