<?php
    require_once("tools.php");

    preShow($_POST);
    echo "<h3>Session</h3>";
    preShow($_SESSION);

    if(empty($_SESSION['cust'])){  //need to add the other fields for being empty
        header('Location: index.php');
    }
    else {
        echo "<h3>There is something here</h3>";
    }

?>