(function(){

    var form = document.getElementById("formLogin"); //obtenemos el formulario
    
    //Evento por si presiona aceptar en el formulario
    form.addEventListener("submit", (e) => {

        e.preventDefault();

        //obtenemos los elementos del formulario
        let usuario = document.getElementById("formUsuario").value.trim(),
            password = document.getElementById("formPassword").value.trim(),
            errorUsuario = document.getElementById("errorUsuario"),
            errorPassword = document.getElementById("errorPassword");

        //si los campos se llenaron correctamente
        if(validarDatos(usuario, password, errorUsuario, errorPassword)){
            //se encripta la contraseña antes de enviarla
            document.getElementById("formPassword").value=CryptoJS.SHA1(password); 
            //enviamos el formulario
            peticion(form);
        }
    }); //le agregamos un evento al enviar el formulario

    /**Función que valida si el formato de los datos es correcto*/
    function validarDatos(usuario, password, errorUsuario, errorPassword){

        //limpiamos los mensajes de error
        errorPassword.innerText="";
        errorUsuario.innerText="";

        let valido=true;//variable a retornar

        if(usuario==null || usuario==""){//si el usuario esta vacio
            errorUsuario.innerText = "Entrada Vacía. Llene el campo obligatorio.";
            valido=false;
        }else if(usuario.length<7){//si el usuario tiene una longitud corta
            errorUsuario.innerText = "Longitud corta. Debe contener al menos 7 carácteres.";
            valido=false;
        }
        if(password==null || password==""){ //si la contraseña esta vacio
            errorPassword.innerText = "Entrada Vacía. Llene el campo obligatorio.";
            valido=false;
        }else if(password.length<8){ //si la contraseña tiene una longitud corta
            errorPassword.innerText = "Longitud corta. Debe contener al menos 7 carácteres.";
            valido=false;
        }
        return valido;
    }

    /**Funcion que realiza una peticion al servidor para comparar el usuario y la contraseña*/
    function peticion(formulario){
        let solicitud = new XMLHttpRequest(); //creamos una solicitud        
        const FD = new FormData(formulario); // objeto para enviarlo mediante ajax
        solicitud.open("POST", "config/login/iniciarSesion.php", true);
        solicitud.setRequestHeader('X-Request-With', 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5'); //coloca una llave para la solicitud AJAX desde el lado del cliente
        solicitud.send(FD);//inicia la solicitud/peticion
        
        //cada que la solicitud cambie de estado
        solicitud.onreadystatechange = function () {
            
            if (solicitud.readyState == 4 && solicitud.status == 200) { //si se completo la solicitud (transaccion)

                const validaciones = JSON.parse(solicitud.responseText); //parseamos el objeto devuelto
                
                //si se establecion la conexion y consulta con exito
                if(validaciones.conexion==true && validaciones.consulta==true && validaciones.ejecucion==true){ 
                    
                    if(validaciones.usuario==true){ //si el usuario existe
                        form.reset();
                        window.location.href="/views/ventas.php"; //se redirecciona a la siguiente pagina
                    }
                    else{ //si el usuario no existe
                        window.alert("Datos erróneos:\nRevisar el usuario y/o contraseña ingresada.");
                        window.location.href="/index.php";
                    }
                } 
                else{ //si la consulta no tuvo exito
                    window.alert("Problemas de conexión, Inténtelo de nuevo más tarde. Lamentamos cualquier inconveniente.");
                }                       
            } else if (solicitud.readyState == 4 && solicitud.status >= 400) { //si no se completo
                console.log(solicitud.responseText);
            }            
        }    
    }//fin de peticion
})();