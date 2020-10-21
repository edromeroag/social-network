<?php
    require_once '../header/header.php';

    if(isset($_SESSION['user'])) {
        destroySession();
        echo "<br><div class='center'>You have been logged out. Please <a data-transition='slide' href='../index.php'>click here</a> to refresh the screen";
    } else
        echo "<div class='center'>You cannot logout because you are not logged in</div>";
?>