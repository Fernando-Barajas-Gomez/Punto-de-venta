<?php
    function conexion(){
        $host = "us-cdbr-east-06.cleardb.net";
        $usuario = "be22cb1bbe0616";
        $password = "dfb9dc9e";
        $db = "heroku_25a5b06ae795ac4";
        $conn = mysqli_connect($host, $usuario, $password, $db);          

        if ($conn==false){
            return false;
        }  
        else{
            return $conn;
        } 
    }
?>