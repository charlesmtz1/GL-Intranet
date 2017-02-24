<?php 
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['sucursal']);
    session_destroy();
    header("Location: login.php")
?>