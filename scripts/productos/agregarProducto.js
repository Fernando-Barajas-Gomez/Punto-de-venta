(function(){

    //obtenemos los elementos que contendran algun evento
    var btnAgregarProducto = document.getElementById("btnAgregarProducto"),
        btnCancelarProducto = document.getElementById("btnCancelarProducto");

    //agregamos el evento
    btnAgregarProducto.addEventListener("click", mostrarModal);
    btnCancelarProducto.addEventListener("click", mostrarModal);

    /**Funcion que se encarga de mostrar y ocultar el modal de agregar productos */
    function mostrarModal(){
        document.getElementById("modalProducto").classList.toggle("oculto"); //le colocamos o quitamos la clase de ocultar
        document.getElementById("formProducto").reset(); //limpiamos el formulario
    }
})();