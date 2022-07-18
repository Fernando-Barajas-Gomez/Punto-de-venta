(function(){
    /**Función autojecutable para cargar los eventos a cada icono de editar una venta*/
    (function(){
        let btnsEliminarVenta=document.getElementsByClassName("btnEliminarVenta");
        for(let i=0;i<btnsEliminarVenta.length;i++)
        {
            btnsEliminarVenta[i].addEventListener("click",() => {
                alert("función no disponible, esta en desarrollo.")
            });
        }
    })();

})();