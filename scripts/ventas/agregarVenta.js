(function(){

    //obtenemos los elementos que contendran algun evento
    var btnCrearVenta = document.getElementById("btnCrearVenta"),
        btnCerrarModal = document.getElementById("btnCerrarVenta"),
        formAgregar = document.getElementById("formVenta");

    //agregamos los eventos a cada boton
    btnCerrarModal.addEventListener("click", mostrarModal); //evento en el boton de cerrar modal

    btnCrearVenta.addEventListener("click", async () => { //evento sobre crear una venta
        btnCrearVenta.disabled=true; //deshabilitamos el boton de crear factura
        let factura = await crearFactura(); //esperamos a que se cree la factura
        if(factura){ //si se creo, mostramos el modal
            limpiarTabla(); //limpiamos las filas agregadas dinamicamente a la tabla
            mostrarModal(); //mostramos el modal de ventas
            btnCrearVenta.disabled=false; //habilitamos el boton de crear factura
        }
    });

    formAgregar.addEventListener("submit", async (e) => {//evento si presiona en aceptar agregar producto

        e.preventDefault();

        //obtenemos los elementos
        let errorCantidad = document.getElementById("errorCantidad"),
            cantidad = document.getElementById("formCantidad").value.trim(),
            idProducto = document.getElementById("formProducto").value.trim(),
            idFactura = document.getElementById("folioVenta").innerText;
        
        if(validarDatos(idProducto, cantidad, errorCantidad)){
            insertarVenta(idProducto, cantidad, idFactura);
        }
    });

    /**Funcion encargada de limpiar todas las filas agregadas dinamicamente */
    function limpiarTabla(){

        //obtenemos el cuerpo de la tabla
        let tabla = document.getElementById("cuerpoTablaModal"),
            filas = tabla.getElementsByTagName("tr"); //las filas

        for(let i=filas.length-1;i>=0;i--){
            tabla.deleteRow(i);
        }
    }

    /**Funcion encargada de enviar los datos a la BD para insertar la nueva venta a la factura*/
    function insertarVenta(idProducto, cantidad, idFactura){
        return new Promise((resolve, reject) => {
            let solicitud = new XMLHttpRequest(); //creamos una solicitud 
            solicitud.open("POST", "../config/ventas/insertarProductoVenta.php?idProducto="+idProducto+"&&cantidad="+cantidad+"&&idFactura="+idFactura); 
            solicitud.setRequestHeader('X-Request-With', 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5'); //coloca una llave para la solicitud AJAX desde el lado del cliente
            solicitud.send();//inicia la solicitud/peticion
            //cada que la solicitud cambie de estado
            solicitud.onreadystatechange = function () {
                if (solicitud.readyState == 4 && solicitud.status == 200) { //si se completo la solicitud (transaccion)
                    const validaciones = JSON.parse(solicitud.responseText); //parseamos el objeto devuelto
                    //si se establecion la conexion y consulta con exito
                    if(validaciones.conexion==true && validaciones.consulta==true && validaciones.ejecucion==true){ 
                        //obtenemos la tabla
                        let tabla = document.getElementById("cuerpoTablaModal");

                        //llamamos a la funcion de agregar producto en la tabla
                        agregarProducto(tabla, 
                                        validaciones.idProducto,
                                        validaciones.idVenta,
                                        validaciones.nombre,
                                        validaciones.descripcion,
                                        validaciones.cantidad,
                                        validaciones.precio,
                                        validaciones.total)

                        //resolvemos la promesa
                        resolve(true);
                    } 
                    else{ //si la consulta no tuvo exito
                        window.alert("Problemas de conexión, Inténtelo de nuevo más tarde. Lamentamos cualquier inconveniente.");
                        resolve(false);
                    }                    
                } else if (solicitud.readyState == 4 && solicitud.status >= 400) { //si no se completo
                    window.alert("No se pudo realizar solicitud ajax");
                }            
            }//fin de onreadystatechange
        });
    }

    /**Funcion que se encarga de agregar el producto a la tabla de ventas */
    function agregarProducto(tabla, idProducto, idVenta, nombreProducto, descripcionProducto, cantidadProducto, precioProducto, totalProducto){
        //creamos los elementos
        let fila = document.createElement("tr"), //creamos una nueva fila
            no = document.createElement("td"), //celda para el número consecutivo
            idProductoTd = document.createElement("td"), //celda con el id del producto
            idVentaTd = document.createElement("td"), //celda con el id de venta
            nombre = document.createElement("td"), //celda con el nombre
            descripcion = document.createElement("td"), //celda con la descripcion
            precio = document.createElement("td"), //celda con el precio
            cantidad = document.createElement("td"), //celda para la cantidad
            total = document.createElement("td"), //celda para el total
            tdEditar = document.createElement("td"), //celda del icono de editar
            tdEliminar = document.createElement("td"), //celda del icono de eliminar
            cntIconoEditar = document.createElement("div"), //contenedor para el icono de editar
            cntIconoEliminar = document.createElement("div") //contenedor para el icono de eliminar
            iconoEditar = document.createElement("object"), //icono de editar
            iconoEliminar = document.createElement("object"); //icono de eliminar

        //añadimos las clases
        no.classList.add("no");
        idProductoTd.classList.add("idProducto"); 
        idProductoTd.classList.add("oculto");
        idVentaTd.classList.add("idVenta"); 
        idVentaTd.classList.add("oculto");
        nombre.classList.add("nombre");
        descripcion.classList.add("descripcion");
        precio.classList.add("precio");
        cantidad.classList.add("cantidad");
        total.classList.add("total");
        tdEditar.classList.add("editar");
        tdEliminar.classList.add("eliminar");
        cntIconoEditar.classList.add("btnEditarProducto");
        cntIconoEliminar.classList.add("btnEliminarProducto");

        //añadimos los datos
        no.innerText = tabla.getElementsByTagName("tr").length+1, //las filas
        idProductoTd.innerText = idProducto;
        idVentaTd.innerText = idVenta;
        nombre.innerText = nombreProducto;
        descripcion.innerText = descripcionProducto;
        cantidad.innerText = cantidadProducto;
        precio.innerText = "$"+Number(precioProducto).toFixed(2).toLocaleString(); //damos formato al precio
        total.innerText ="$"+Number(totalProducto).toFixed(2).toLocaleString();

        //añadimos los iconos
        iconoEditar.type = "image/svg+xml";
        iconoEliminar.type = "image/svg+xml";
        iconoEditar.data = "../iconos/editar.svg";
        iconoEliminar.data = "../iconos/eliminar.svg";

        //añadimos los eventos a los botones
        cntIconoEditar.addEventListener("click", () => {
            alert("función no disponible, esta en desarrollo.")
        });
        cntIconoEliminar.addEventListener("click", () => {
            alert("función no disponible, esta en desarrollo.")
        });

        //añadimos los hijos
        //los objetos (iconos) a sus celdas
        cntIconoEditar.appendChild(iconoEditar);
        cntIconoEliminar.appendChild(iconoEliminar);
        tdEditar.appendChild(cntIconoEditar);
        tdEliminar.appendChild(cntIconoEliminar);
        //las celdas a la fila
        fila.appendChild(no)
        fila.appendChild(idProductoTd);
        fila.appendChild(idVentaTd);
        fila.appendChild(nombre);
        fila.appendChild(descripcion);
        fila.appendChild(cantidad);
        fila.appendChild(precio);
        fila.appendChild(total);
        fila.appendChild(tdEditar);
        fila.appendChild(tdEliminar);

        //añadimos la fila al final de los elementos
        tabla.appendChild(fila);

        //enviamos los valores a sumar para actualizar los totales
        nuevoConteo(cantidadProducto, totalProducto);
    }

    /**Funcion que se encarga de realizar un nuevo conteo de productos y total de precio de la tabla*/
    function nuevoConteo(cantProducto, totalProducto){

        //obtenemos los elementos con la cantidad actual
        let totalProductoLabel = document.getElementById("totalProductos"), //total de productos
            totalVentaLabel = document.getElementById("totalVenta"); //total final
        
        //eliminamos el simbolo de pesos para poder realizar la operacion
        totalVentaLabel.innerText = totalVentaLabel.innerText.replace("$","");
        let total = parseFloat(totalVentaLabel.innerText) + parseFloat(totalProducto);;
            
        
        totalProductoLabel.innerText = parseFloat(totalProductoLabel.innerText) + parseFloat(cantProducto);
        totalVentaLabel.innerText = "$"+Number(total).toFixed(2).toLocaleString();
        
    }

    /**Función que valida si el formato de los datos es correcto*/
    function validarDatos(idProducto, cantidad, errorCantidad){

        //limpiamos los mensajes de error
        errorCantidad.innerText="";

        //regex para validar entradas numericas con punto decimal sin comas
        let numerosRegex = /^[0-9]+$/i;

        let valido=true;//variable a retornar

        if(idProducto==null || idProducto==""){//si el id del producto esta vacio
            errorCantidad.innerText = "Producto Vacío.";
            valido=false;
        }
        else if(!numerosRegex.test(idProducto)){ //si el id del producto no es númerico
            errorCantidad.innerText = "Id del producto no númerico";
            valido=false;
        }

        if(cantidad==null || cantidad==""){//si la cantidad está vacía
            errorCantidad.innerText += "Cantidad Vacía. Campo obligatorio";
            valido=false;
        }
        else if(!numerosRegex.test(cantidad)){ //si la cantidad no es númerica
            errorCantidad.innerText += "La cantidad debe ser númerica";
            valido=false;
        }
        return valido;
    }

    /**Funcion que se encarga de mostrar y ocultar el modal de agregar productos */
    function mostrarModal(){
        document.getElementById("modalVenta").classList.toggle("oculto"); //le colocamos o quitamos la clase de ocultar
        document.getElementById("formVenta").reset(); //limpiamos el formulario
    }

    /**Función encargada de crear la nueva factura para poder añadirle productos */
    function crearFactura(){
        return new Promise((resolve, reject) => {
            let solicitud = new XMLHttpRequest(); //creamos una solicitud 
            solicitud.open("POST", "../config/ventas/crearFactura.php"); 
            solicitud.setRequestHeader('X-Request-With', 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5'); //coloca una llave para la solicitud AJAX desde el lado del cliente
            solicitud.send();//inicia la solicitud/peticion
            //cada que la solicitud cambie de estado
            solicitud.onreadystatechange = function () {
                if (solicitud.readyState == 4 && solicitud.status == 200) { //si se completo la solicitud (transaccion)
                    const validaciones = JSON.parse(solicitud.responseText); //parseamos el objeto devuelto
                    //si se establecion la conexion y consulta con exito
                    if(validaciones.conexion==true && validaciones.consulta==true && validaciones.ejecucion==true){ 
                        
                        //colocamos la fecha y id de la factura en el modal
                        document.getElementById("folioVenta").innerText = validaciones.id;
                        document.getElementById("fechaVenta").innerText = validaciones.fecha;
                        
                        resolve(true);
                    } 
                    else{ //si la consulta no tuvo exito
                        window.alert("Problemas de conexión, Inténtelo de nuevo más tarde. Lamentamos cualquier inconveniente.");
                        resolve(false);
                    }                    
                } else if (solicitud.readyState == 4 && solicitud.status >= 400) { //si no se completo
                    window.alert("No se pudo realizar solicitud ajax");
                }            
            }//fin de onreadystatechange
        });
    }

})();