(function(){

    /**Función autojecutable para cargar los eventos a cada icono de editar un producto*/
    (function(){
        let btnsEditarProducto=document.getElementsByClassName("btnEditarProducto");
        for(let i=0;i<btnsEditarProducto.length;i++)
        {
            btnsEditarProducto[i].addEventListener("click", () => {
                alert("función no disponible, esta en desarrollo.")
            });
        }
    })();
})();