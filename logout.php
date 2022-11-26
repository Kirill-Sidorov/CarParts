<?php
    include_once "utils/checkuser.php";
    session_destroy();
    header( "Location: https://localhost/carparts/login.php", true, 303);
?>