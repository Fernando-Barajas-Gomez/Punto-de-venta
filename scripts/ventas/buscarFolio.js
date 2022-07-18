(function(){
    var buscador = document.getElementById("buscarFolio");

    buscador.addEventListener("keyup", buscar);

    /**Metodo encargado de buscar el producto en la tabla*/
    function buscar(){
         
        let datoBuscar=buscador.value.trim(), //el dato a buscar
            errorFolio = document.getElementById("errorFolio");//label del error de folio
        
        //validamos que el folio sea númerico
        if(esEntero(datoBuscar, errorFolio)){
            //obtenemos la tabla y cada fila
            let cuerpoTabla = document.getElementById("cuerpoTablaVentas"), //el cuerpo de la tabla
                filas = cuerpoTabla.getElementsByTagName("tr"), //las filas
                contador=0;

            console.log(filas.length);
            //recorremos las filas menos una para evitar buscar en la que muestra el error
            for(i=0; i<filas.length-1;i++){
                console.log(filas.length);
                let folio = filas[i].getElementsByClassName("id"), //obtenemos la casilla con el folio-id
                    id = folio[0].innerText; //obtenemos el nombre del producto

                //los comparamos si son iguales
                if(datoBuscar.length == 0 || id.indexOf(datoBuscar) > -1){ //si coinciden lo muestra
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
    }

    /**Función que valida si la entrada es númerica */
    function esEntero(folio, errorFolio){
        errorFolio.innerText = "";

        //regex para validar entradas numericas 
        var numerosRegex = /^[0-9]*$/i;

        if(!numerosRegex.test(folio)){
            errorFolio.innerText = "El dato debe ser de tipo númerico.";
            return false;
        }else{
            return true;
        }
    }
})();