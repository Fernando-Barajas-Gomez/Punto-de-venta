<?php
    //https://www.doabledanny.com/Deploy-PHP-And-MySQL-to-Heroku
    //mysql://be22cb1bbe0616:dfb9dc9e@us-cdbr-east-06.cleardb.net/heroku_25a5b06ae795ac4?reconnect=true
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login/login.css">
    <title>Punto de venta</title>
</head>
<body>
    <div class="desenfoque centrar">
        <form action="">
            <h2>Login</h2>
            <div class="campo">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" required>
            </div>
            <div class="campo">
                <label for="password">Contraseña:</label>
                <input type="text" name="password" required>
            </div>
            <div class="campo centrar">
                <input type="submit" value="Ingresar">
            </div>  
        </form>
    </div>
</body>
</html>