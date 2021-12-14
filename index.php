<?php
    if($_SERVER['HTTP_HOST'] == 'localhost'){
        define('ROOT_URL', '/loft_digital_coding_test/');
    } else {
        define('ROOT_URL', '/');
    }

    require "./templates/home.php";
?>