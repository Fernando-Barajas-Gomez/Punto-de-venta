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
                    <object data="../iconos/lupa.svg" type="image/svg+xml"></object>
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
                                <td class="id"><?php echo $producto['id']; ?></td>
                                <td class="nombre"><?php echo $producto['nombre']; ?></td>
                                <td class="descripcion"><?php echo $producto['descripcion']; ?></td>
                                <td class="precio"><?php echo "$".number_format($producto['precio'], 2, '.', ''); ?></td>
                                <td class="editar"><div><object data="../iconos/editar.svg" type="image/svg+xml"></object></div></td>
                                <td class="eliminar"><div><object data="../iconos/eliminar.svg" type="image/svg+xml"></object></div></td>
                            </tr>
                        <?php endforeach;?> 
                            <tr class='oculto' id="encontrado">
                                <td colspan="6">Producto no encontrado</td>
                            </tr>
                    </tbody>  
                </table>                          
            </div>
        </div>
    </main>
    <script src="../scripts/productos/agregarProducto.js"></script>
    <script src="../scripts/productos/buscarProducto.js"></script>
</body>
</html>