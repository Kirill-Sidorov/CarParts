<?php
    while (list($var,$value) = each($_SERVER)) :
                    echo "<BR>$var => $value";
    endwhile;

    print "
        <h1>--------------------------------</h1>
        <br>Hi! Your IP address is: $_SERVER[REMOTE_ADDR]
        <br>Имя компьютера: $_SERVER[SERVER_NAME]
        <h1>--------------------------------</h1>
    ";
?>
