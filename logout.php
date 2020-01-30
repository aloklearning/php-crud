<?php
    session_start();
    session_destroy(); //destroys the session
    include('lib/config.php');
    header('location: '.BASEURL.'login.php');    
?>