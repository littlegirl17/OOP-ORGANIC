<?php

    ob_start();

    define('APPURL','http://localhost:8080/Organic_PHP2/');
    
    if(!isset($_SESSION['mygiohang'])) {
        $_SESSION['mygiohang'] = array();
    }

?>