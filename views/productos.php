<?php
    session_start();
    //si no se ha creado una sesion
    if(!isset($_SESSION['usuario']) && !isset($_SESSION['id'])){
        header('location: ../index.php'); //se le redirige al login
    }else{

        //archivo con las consultas
        require_once("../config/consultas.php");
        $consulta =  new consultas(); //instanciamos el objeto
        $productos = $consulta->productos(); //obtenemos los productos de la bd
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/productos/productos.css">
    <link rel="stylesheet" href="../styles/menu/menu.css">
    <title>Punto de ventas</title>
</head>
<body>
    <!--Incluimos los recursos necesarios como el modal y el header-->
    <?php include_once ('recursos/header.php');?>
    <?php include_once ('recursos/modalProducto.php');?>
    <main>
        <div class="cntBotonAgregar">
            <h1>Consultar Productos</h1>
            <input type="button" value="Agregar Producto" id="btnAgregarProducto">
        </div>
        <!--Contenendor que contendra todo lo relacionado a la gestión de los productos en la DB-->
        <div class="cntProductos">

            <!--Buscador-->
            <div class="cntBuscador">
                <div class="buscador" id="buscador">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <input type="text" placeholder="Buscar producto" id="buscarProducto">
                </div>               
            </div>
            <!--Tabla-->
            <div class="ctnTabla">
                <table id="tabla">
                    <!-- Encabezados -->
                    <thead>
                        <tr>
                            <th class="id">ID</th>
                            <th class="nombre">Nombre</th>
                            <th class="descripcion">Descripción</th>
                            <th class="precio">Precio</th>
                            <th class="editar"></th> 
                            <th class="borrar"></th>                    
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody id="cuerpoTabla">
                        <!--Si no existe ningún producto-->
                        <?php if($productos->num_rows <= 0){
                            echo "<tr>
                                    <td colspan='6'>No hay ningún producto registrado</td>
                                </tr>";
                        } ?>
                        <!--Colocamos cada producto-->
                        <?php foreach($productos as $producto): ?>
                            <tr>
                                <td class="id"><?php echo $producto['id'];?></td>
                                <td class="nombre"><?php echo $producto['nombre'];?></td>
                                <td class="descripcion"><?php echo $producto['descripcion'];?></td>
                                <td class="precio"><?php echo $producto['precio'];?></td>
                                <td class="editar"></td>
                                <td class="borrar"></td>
                            </tr>
                        <?php endforeach;?> 
                            <!-- <tr class='noEncontrado hide'>
                                <td colspan="6"></td>
                            </tr> -->
                    </tbody>  
                </table>                          
            </div>
        </div>
    </main>
    <script src="../scripts/productos/agregarProducto.js"></script>
</body>
</html>