<?php
    session_start();
    session_destroy();
    header('location: ./../../administrador/index.php');
?>