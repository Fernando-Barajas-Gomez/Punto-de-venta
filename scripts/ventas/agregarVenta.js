(function(){

    //obtenemos los elementos que contendran algun evento
    var btnCrearVenta = document.getElementById("btnCrearVenta"),
        btnCerrarModal = document.getElementById("btnCerrarVenta");

    //agregamos los eventos a cada boton
    btnCerrarModal.addEventListener("click", mostrarModal);
    btnCrearVenta.addEventListener("click", async () => {
        btnCrearVenta.disabled=true; //deshabilitamos el boton de crear factura
        let factura = await crearFactura(); //esperamos a que se cree la factura
        if(factura){ //si se creo, mostramos el modal
            mostrarModal(); //mostramos el modal de ventas
            btnCrearVenta.disabled=false; //habilitamos el boton de crear factura
        }
    });

    /**Funcion que se encarga de mostrar y ocultar el modal de agregar productos */
    function mostrarModal(){
        document.getElementById("modalVenta").classList.toggle("oculto"); //le colocamos o quitamos la clase de ocultar
        document.getElementById("formVenta").reset(); //limpiamos el formulario
    }

    /**Función encargada de crear la nueva factura para poder añadirle productos */
    function crearFactura(){
        return new Promise((resolve, reject) => {
            var solicitud = new XMLHttpRequest(); //creamos una solicitud 
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