(function(){

    /**Función autojecutable para cargar los eventos a cada icono de editar una venta*/
    (function(){
        let btnsEditarVenta=document.getElementsByClassName("btnEditarVenta");
        for(let i=0;i<btnsEditarVenta.length;i++)
        {
            btnsEditarVenta[i].addEventListener("click",() => {
                alert("función no disponible, esta en desarrollo.")
            });
        }
    })();

})();