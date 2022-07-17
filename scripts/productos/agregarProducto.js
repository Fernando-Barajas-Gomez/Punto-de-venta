(function(){

    //obtenemos los elementos que contendran algun evento
    var btnAgregarProducto = document.getElementById("btnAgregarProducto"),
        btnCancelarProducto = document.getElementById("btnCancelarProducto"),
        formProducto = document.getElementById("formProducto");
        

    //agregamos los eventos a cada boton
    btnAgregarProducto.addEventListener("click", mostrarModal);
    btnCancelarProducto.addEventListener("click", mostrarModal);
    //si da en aceptar en el formulario
    formProducto.addEventListener("submit", async (e) => {
        e.preventDefault();

        //obtenemos los elementos del formulario
        let nombreProducto = document.getElementById("nombreProducto").value.trim(),
            descripcionProducto = document.getElementById("descripcionProducto").value.trim(),
            precioProducto = document.getElementById("precioProducto").value.trim(),
            errorNombre = document.getElementById("errorNombre"),
            errorDescripcion = document.getElementById("errorDescripcion"),
            errorPrecio = document.getElementById("errorPrecio");

         //si los campos se llenaron correctamente
         if(validarDatos(nombreProducto, descripcionProducto, precioProducto, errorNombre, errorDescripcion, errorPrecio)){
            
            //si el formato de los datos es correcto, checamos que el nombre este disponible ya que debe ser único  
            let disponible = await nombreDisponible(nombreProducto);
            if(disponible){
                //continuar aqui con agregar producto
            }else{
                errorNombre.innerText = "Nombre no disponible, seleccione uno distinto.";
            }
        }
    });

    /**Función que valida la disponibilidad del nombre del nuevo producto */
    function nombreDisponible(nombreProducto){
        return new Promise((resolve, reject) => {
            var solicitud = new XMLHttpRequest(); //creamos una solicitud 
            solicitud.open("POST", "../config/productos/nombreDisponible.php?nombre="+nombreProducto); //para manejar la solicitud asincronamente(true) y enviamos los datos
            solicitud.setRequestHeader('X-Request-With', 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5'); //coloca una llave para la solicitud AJAX desde el lado del cliente
            solicitud.send();//inicia la solicitud/peticion
            //cada que la solicitud cambie de estado
            solicitud.onreadystatechange = function () {
                if (solicitud.readyState == 4 && solicitud.status == 200) { //si se completo la solicitud (transaccion)
                    const validaciones = JSON.parse(solicitud.responseText); //parseamos el objeto devuelto
                    //si se establecion la conexion y consulta con exito
                    if(validaciones.conexion==true && validaciones.consulta==true && validaciones.ejecucion==true){ 
                        if(validaciones.existe==true){ //si el nombre ya existe
                            resolve(false);
                        }
                        else{ //si el nombre no existe
                           resolve(true);
                        }
                    } 
                    else{ //si la consulta no tuvo exito
                        window.alert("Problemas de conexión, Inténtelo de nuevo más tarde. Lamentamos cualquier inconveniente.");
                    }                    
                } else if (solicitud.readyState == 4 && solicitud.status >= 400) { //si no se completo
                    window.alert("No se pudo realizar solicitud ajax");
                }            
            }//fin de onreadystatechange
        });
    }

    /**Función que valida si el formato de los datos es correcto*/
    function validarDatos(nombreProducto, descripcionProducto, precioProducto, errorNombre, errorDescripcion, errorPrecio){

        //limpiamos los mensajes de error
        errorNombre.innerText="";
        errorDescripcion.innerText="";
        errorPrecio.innerText="";

        //regex para validar entradas numericas con punto decimal sin comas
        var numerosRegex = /^[0-9]+([.])?([0-9]+)?$/i;

        let valido=true;//variable a retornar

        if(nombreProducto==null || nombreProducto==""){//si el nombre esta vacio
            errorNombre.innerText = "Entrada Vacía. Llene el campo obligatorio.";
            valido=false;
        }
        if(descripcionProducto==null || descripcionProducto==""){ //si la contraseña esta vacio
            errorDescripcion.innerText = "Entrada Vacía. Llene el campo obligatorio.";
            valido=false;
        }
        if(precioProducto==null || precioProducto==""){ //si la contraseña esta vacio
            errorPrecio.innerText = "Entrada Vacía. Llene el campo obligatorio.";
            valido=false;
        }
        else if(!numerosRegex.test(precioProducto)){
            errorPrecio.innerText = "El dato debe ser de tipo númerico.";
            valido=false;
        }
        return valido;
    }

    /**Funcion que se encarga de mostrar y ocultar el modal de agregar productos */
    function mostrarModal(){
        document.getElementById("modalProducto").classList.toggle("oculto"); //le colocamos o quitamos la clase de ocultar
        document.getElementById("formProducto").reset(); //limpiamos el formulario
    }


})();