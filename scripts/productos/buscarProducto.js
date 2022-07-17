(function(){
    var buscador = document.getElementById("buscarProducto");

    buscador.addEventListener("keyup", buscar);

    /**Metodo encargado de buscar el producto en la tabla*/
    function buscar(){

        //el dato a buscar lo convertimos a minusculas
        datoBuscar=buscador.value.trim().toLowerCase();
        
        //obtenemos la tabla y cada fila
        let cuerpoTabla = document.getElementById("cuerpoTabla"), //el cuerpo de la tabla
            filas = cuerpoTabla.getElementsByTagName("tr"), //las filas
            contador=0;

        //recorremos las filas menos una para evitar buscar en la que muestra el error
        for(i=0; i<filas.length-1;i++){
            
            let nombres = filas[i].getElementsByClassName("nombre"), //obtenemos la casilla con el nombre
                nombre = nombres[0].innerText.toLowerCase(); //obtenemos el nombre del producto

            //los comparamos si son iguales
            if(datoBuscar.length == 0 || nombre.indexOf(datoBuscar) > -1){ //si coinciden lo muestra
                filas[i].style.display = ''; 
            }
            else{ //si no es igual
                filas[i].style.display = 'none'; //ocultamos el elemento
                contador++; //aumentamos el contador
            }             
        }

        //si el dato a buscar esta vacio, ocultamos el mensaje
        if (datoBuscar == "") {
            document.getElementById("encontrado").classList.add("oculto");
        }
        else
        if(contador==filas.length-1){ //si no encontro ninguno, mostramos el mensaje, es decir, se recorrieron todas las filas y no se encontro ninguna coincidencia
            document.getElementById("encontrado").classList.remove("oculto");
        }

    }
})();