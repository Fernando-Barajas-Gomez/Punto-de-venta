(function(){

    //obtenemos los elementos que contendran algun evento
    var btnCrearVenta = document.getElementById("btnCrearVenta");

    //agregamos los eventos a cada boton
    btnCrearVenta.addEventListener("click", mostrarModal);


    /**Funcion que se encarga de mostrar y ocultar el modal de agregar productos */
    function mostrarModal(){
        document.getElementById("modalVenta").classList.toggle("oculto"); //le colocamos o quitamos la clase de ocultar
        document.getElementById("formVenta").reset(); //limpiamos el formulario
    }


})();