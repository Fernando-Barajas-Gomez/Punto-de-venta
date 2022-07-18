(function(){

    /**Función autojecutable para cargar los eventos a cada icono de editar una venta*/
    (function(){
        let btnsEditarVenta=document.getElementsByClassName("btnEditarVenta");
        for(let i=0;i<btnsEditarVenta.length;i++)
        {
            btnsEditarVenta[i].addEventListener("click",mostrarModal);
        }
    })();

    /**Funcion que se encarga de mostrar y ocultar el modal de agregar productos */
    function mostrarModal(){
        document.getElementById("modalVenta").classList.toggle("oculto"); //le colocamos o quitamos la clase de ocultar
        document.getElementById("formVenta").reset(); //limpiamos el formulario
    }

})();