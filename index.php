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
        <form action="" id="formLogin" method="POST">
            <h2>Login</h2>
            <div class="campo">
                <label for="usuario">*Usuario:</label>
                <input type="text" name="usuario" placeholder="Ejemplo: usuariox35" id="formUsuario">
                <label class="error" id="errorUsuario"></label>
            </div>
            <div class="campo">
                <label for="password">*Contraseña:</label>
                <input type="password" name="password" placeholder="Ejemplo: c0ntras3ñ@." id="formPassword">
                <label class="error" id="errorPassword"></label>
            </div>
            <div class="campo centrar">
                <input type="submit" value="Ingresar">
            </div>  
        </form>
    </div>

    <script src="scripts/login/login.js"></script>
    <script src="scripts/login/encriptado.js"></script>
</body>
</html>