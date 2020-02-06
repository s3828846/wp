<?php session_start(); ?>

<h3>$_SESSION contians:</h3>
<pre><?php print_r($_SESSION); ?></pre>

<h3>$_GET contains:</h3>
<pre><?php print_r($_GET); ?></pre>

$post = print_r($_POST, true);
echo "<h3>\$_POST contains:</h3>
<pre>
  $post
</pre>";

<h3>$_COOKIE contains:</h3>
<pre><?php print_r($_COOKIE); ?></pre>

<h3>$_REQUEST contains:</h3>
<pre><?php print_r($_REQUEST); ?></pre>