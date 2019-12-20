<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    
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
      <div>
        About Us
        Prices
        Now Showing
      </div>
    </nav>

    <main>
      <article>
        <h2> About Us </h2>
      </article>
      <article>
        <h2> Prices
      </article>
      <article>
        <h2>Now Showing</h2
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
