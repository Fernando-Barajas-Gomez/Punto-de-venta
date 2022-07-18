<!--Modal para agregar y editar alguna venta-->
<div class="cntModalVenta oculto" id="modalVenta">
    <div class="cntGeneralVenta">
        <!--Detalles de la venta-->
        <div class="detalles">
            <h3>Venta</h3>
            <h4>Folio:</h4>
            <h4 id="folioVenta"></h2>
            <h4>Fecha:</h4>
            <h4 id="fechaVenta"></h2>
        </div>
        <!--Contenedor para agregarle productos-->
        <form action="" id="formVenta">
            <div class="campo">
                <label for="producto">*Producto:</label>
                <select name="producto" id="formProducto">
                    <!--Colocamos cada producto-->
                    <?php foreach($productos as $producto): ?>
                        <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
                    <?php endforeach;?> 
                </select>
                <label class="error" id="errorNombre"></label>
            </div>
            <div class="campo">
                <label for="cantidad">*Cantidad:</label>
                <input type="text" name="cantidad" id="formCantidad" placeholder="Ejemplo: 2">
            </div>
            <input type="submit" value="Agregar Producto" id="btnAgregarProducto">
        </form>
        <!--Label para mostrar los errores al agregar un producto a la venta-->
        <label class="error" id="errorCantidad"></label>
        <!--Cada producto añadido-->
        <!--Tabla-->
        <div class="cntTablaModal">
            <table id="tablaVenta">
                <!-- Encabezados -->
                <thead>
                    <tr>
                        <th class="no">No.</th>
                        <th class="idProducto oculto">ID producto</th>
                        <th class="idVenta oculto">ID venta</th>
                        <th class="nombre">Producto</th>
                        <th class="descripción">Descripcion</th>
                        <th class="cantidad">Cantidad</th> 
                        <th class="precio">Precio</th> 
                        <th class="total">Total</th> 
                        <th class="editar">Editar</th>  
                        <th class="eliminar">Eliminar</th>  
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
                <tbody id="cuerpoTablaModal">
                    <!--Colocamos cada venta-->
                    <!-- <?php 
                        $i=1;
                        foreach($productosFactura as $productoFactura): ?>
                        <tr>
                            <td class="no"><?php echo $i++; ?></td>
                            <td class="id oculto"><?php echo $productoFactura['id']; ?></td>
                            <td class="nombre"><?php echo $productoFactura['nombre']; ?></td>
                            <td class="descripción"><?php echo $productoFactura['descripcion']; ?></td>
                            <td class="cantidad"><?php echo $productoFactura['cantidad']; ?></td> 
                            <td class="precio"><?php echo $productoFactura['precio']; ?></td> 
                            <td class="total"><?php echo $productoFactura['total']; ?></td>     
                            <td class="editar"><object data="../iconos/editar.svg" type="image/svg+xml"></object></td>
                            <td class="eliminar"><object data="../iconos/eliminar.svg" type="image/svg+xml"></object></td>
                        </tr>
                    <?php endforeach;?>  -->
                </tbody>  
            </table>                          
        </div>
        <!--Elementos de total de productos y total-->
        <div class="cntTotales">
            <div class="campo">
                <label for="">Total de productos:</label>
                <label for="" id="totalProductos">0</label>
            </div>
            <div class="campo">
                <label for="">Total de venta:</label>
                <label for="" id="totalVenta">0</label>
            </div>
        </div>
        <!--Elementos de total de productos y total-->
        <div class="cntBotones">
            <input type="button" value="Cerrar" id="btnCerrarVenta">
            <input type="button" value="Eliminar">
        </div>
    </div>
</div>