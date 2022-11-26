<?php
    session_start();
    if (!isset($_SESSION['userRole'])) {
        header( "Location: https://localhost/carparts/login.php", true, 303);
        exit();
    }
?>