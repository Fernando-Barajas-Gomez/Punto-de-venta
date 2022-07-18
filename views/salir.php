<?php
    session_start();
    //si no se ha creado una sesion
    if(!isset($_SESSION['usuario']) && !isset($_SESSION['id'])){
        header('location: ../index.php'); //se le redirige al login
    }else{
        //destruye la sesion
        session_unset();
        session_destroy();
        header('location: ../index.php');
    }
?>