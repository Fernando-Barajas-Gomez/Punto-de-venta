(function(){
    /**Función autojecutable para cargar los eventos a cada icono de editar un producto*/
    (function(){
        let btnsEliminarProducto=document.getElementsByClassName("btnEliminarProducto");
        for(let i=0;i<btnsEliminarProducto.length;i++)
        {
            btnsEliminarProducto[i].addEventListener("click", () => {
                alert("función no disponible, esta en desarrollo.")
            });
        }
    })();

})();