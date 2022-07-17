<!--Modal para agregar y editar algun producto-->
<div class="cntModalProducto oculto" id="modalProducto">
    <form action="" id="formProducto">
        <h3>Producto</h3>
        <div class="campo">
            <label for="nombre">*Nombre:</label>
            <input type="text" name="nombre" id="nombreProducto" placeholder="Ejemplo: objeto marca tal">
        </div>
        <div class="campo">
            <label for="descripcion">*Descripción:</label>
            <input type="text" name="descripcion" id="descripcionProducto" placeholder="Ejemplo: Sirve para esto...">
        </div>
        <div class="campo">
            <label for="precio">*Precio:</label>
            <input type="text" name="precio" id="precioProducto" placeholder="Ejemplo: $20.00">
        </div>
        <div class="cntBotones">
            <input type="button" value="Cancelar" id="btnCancelarProducto">
            <input type="button" value="Aceptar" id="btnAceptarProducto">
        </div>
    </form>
</div>