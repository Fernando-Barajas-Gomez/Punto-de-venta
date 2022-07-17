<!--Modal para agregar y editar alguna venta-->
<div class="cntModalVenta oculto" id="modalVenta">
    <h3>Venta</h3>
    <form action="" id="formVenta">
        
        <div class="campo">
            <label for="nombre">*Nombre:</label>
            <input type="text" name="nombre" id="nombreProducto" placeholder="Ejemplo: objeto marca tal">
            <label class="error" id="errorNombre"></label>
        </div>
        <div class="campo">
            <label for="descripcion">*Descripción:</label>
            <input type="text" name="descripcion" id="descripcionProducto" placeholder="Ejemplo: Sirve para esto...">
            <label class="error" id="errorDescripcion"></label>
        </div>
        <div class="campo">
            <label for="precio">*Precio:</label>
            <input type="text" name="precio" id="precioProducto" placeholder="Ejemplo: $20.00">
            <label class="error" id="errorPrecio"></label>
        </div>
        <div class="cntBotones">
            <input type="button" value="Cerrar" id="btnCancelarProducto">
            <input type="submit" value="Aceptar" id="btnAceptarProducto">
        </div>
    </form>
</div>