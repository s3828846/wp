<?php
    require_once("tools.php");

    preShow($_POST);
    echo "<h3>Session</h3>";
    preShow($_SESSION);

    if(empty($_SESSION)){
        header("Location: " . $_SERVER["HTTP_REFERER]"]);
    }
    else {
        echo "<h3>There is something here</h3>";
    }

?>