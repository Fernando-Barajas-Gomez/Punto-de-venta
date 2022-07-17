<?php
    session_start();
    //si no se ha creado una sesion
    if(!isset($_SESSION['usuario']) && !isset($_SESSION['id'])){
        header('location: ../index.php'); //se le redirige al login
    }else{
        //archivo con las consultas
        require_once("../config/consultas.php");
        $consulta =  new consultas(); //instanciamos el objeto
        $facturas = $consulta->facturas(); //obtenemos las facturas de la bd
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/ventas/ventas.css">
    <link rel="stylesheet" href="../styles/menu/menu.css">
    <title>Punto de ventas</title>
</head>
<body>
    <!--Incluimos los recursos necesarios como el modal y el header-->
    <?php include_once ('recursos/header.php');?>
    <?php include_once ('recursos/modalVenta.php');?>
    <main>
        <div class="cntBotonCrear">
            <h1>Consultar Ventas</h1>
            <input type="button" value="Crear venta" id="btnCrearVenta">
        </div>
        <!--Contenendor que contendra todo lo relacionado a la gestión de las ventas en la DB-->
        <div class="cntVentas">

            <!--Buscador-->
            <div class="cntBuscador">
                <label for="">Folio de venta:</label>
                <div class="buscador" id="buscador">
                    <object data="../iconos/lupa.svg" type="image/svg+xml"></object>
                    <input type="text" placeholder="Buscar venta por folio, ejemplo: 120" id="buscarFolio">
                </div>               
            </div>
            <!--Tabla-->
            <div class="ctnTabla">
                <table id="tabla">
                    <!-- Encabezados -->
                    <thead>
                        <tr>
                            <th class="id">Folio</th>
                            <th class="nombre">Quien la hizo</th>
                            <th class="fecha">Fecha</th>
                            <th class="editar">Editar</th> 
                            <th class="borrar">Eliminar</th>                    
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody id="cuerpoTabla">
                        <!--Si no existe ningún venta-->
                        <?php if($facturas->num_rows <= 0){
                            echo "<tr>
                                    <td colspan='5'>No hay ninguna venta registrada</td>
                                </tr>";
                        } ?>
                        <!--Colocamos cada venta-->
                        <?php foreach($facturas as $factura): ?>
                            <tr>
                                <td class="id"><?php echo $factura['id']; ?></td>
                                <td class="nombre"><?php echo $factura['usuario']; ?></td>
                                <td class="fecha"><?php echo $factura['fecha']; ?></td>
                                <td class="editar"><object data="../iconos/editar.svg" type="image/svg+xml"></object></td>
                                <td class="eliminar"><object data="../iconos/eliminar.svg" type="image/svg+xml"></object></td>
                            </tr>
                        <?php endforeach;?> 
                            <tr class='oculto' id="encontrado">
                                <td colspan="6">Folio no encontrado</td>
                            </tr>
                    </tbody>  
                </table>                          
            </div>
        </div>
    </main>

    <script src="../scripts/ventas/agregarVenta.js"></script>
</body>
</html>