<?php
    session_start();
    //si no se ha creado una sesion
    if(!isset($_SESSION['usuario']) && !isset($_SESSION['id'])){
        header('location: ../index.php'); //se le redirige al login
    }
?>