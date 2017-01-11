<?php
    include "config.php";

    // If dev mode is false, redirect user to web/
    if(!\EasyReheat\GlobalConfig::$dev_mode){
        header('Location: web/');
    }

?>
