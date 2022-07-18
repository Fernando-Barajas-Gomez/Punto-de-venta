<?php

    //si es igual la llave ajax
    if(Peticion()) {   
        //revisamos que las variables esten colocadas
        if(isset($_REQUEST["idProducto"]) && isset($_REQUEST["cantidad"]) && isset($_REQUEST["idFactura"])) {

            //pasamos los datos para corroborarlos
            echo agregarProductoVenta($_REQUEST["idProducto"], $_REQUEST["cantidad"], $_REQUEST["idFactura"]);
        }

    } 
    else { //si no es igual la llave
        echo "Error.<br>La llave ingresada: ".$_SERVER['HTTP_X_REQUEST_WITH']."<br>No es valida";
    }

    /**  Función que revisa la peticion, que sea de tipo AJAX y checa que la llave sea igual*/
    function Peticion(){
        return isset($_SERVER['HTTP_X_REQUEST_WITH']) && $_SERVER['HTTP_X_REQUEST_WITH'] == 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5';
    }

    /** Funcion encargada de agregar un producto a una factura y devolver el id de venta de la DB*/
    function agregarProductoVenta($idProducto, $cantidad, $idFactura){

        //archivo con la conexion
        require_once ('../conexion.php');
        $conexion=conexion(); //generamos una conexion

        //objeto que registra si se realizo o no alguna accion
        $validaciones=new stdClass();

        if(!$conexion){ //se no se logro una conexcion con la base de datos
            $validaciones -> conexion = false;
        }
        else{ //si se logro la conexion con la base de datos
            $validaciones -> conexion = true;

            //generamos la consulta
            $consulta = $conexion->prepare("INSERT INTO ventas (idProducto, cantidad, idFactura) VALUES (?,?,?);");       
            
            if($consulta){ //si se realizo con exito
                $validaciones -> consulta = true; 

                //colocamos los parametros
                $consulta->bind_param("iii", $idProducto, $cantidad, $idFactura);          
                
                if($consulta->execute()){  //si se ejecuto con exito la sentencia
                    $validaciones -> ejecucion = true;   

                    //obtener el id del producto agregado
                    $consulta2 = $conexion->prepare("SELECT v.id AS idVenta, p.id AS idProducto, p.nombre, p.descripcion, v.cantidad, p.precio, SUM(p.precio*v.cantidad) AS total FROM ventas AS v, productos AS p, factura as f WHERE v.idProducto=p.id AND v.idFactura=f.id AND v.idProducto=? AND v.cantidad=? AND f.id=?");
                    $consulta2->bind_param("iii", $idProducto, $cantidad, $idFactura); 
                    $consulta2->execute();   
                    $resultado=$consulta2->get_result();
                    $venta = mysqli_fetch_assoc($resultado);
              
                    //asignamos el dato al objeto a retornar
                    $validaciones -> idVenta = $venta['idVenta'];
                    $validaciones -> idProducto = $venta['idProducto'];
                    $validaciones -> nombre = $venta['nombre'];
                    $validaciones -> descripcion = $venta['descripcion'];
                    $validaciones -> cantidad = $venta['cantidad'];
                    $validaciones -> precio = $venta['precio'];
                    $validaciones -> total = $venta['total'];
                }
                else{//si la ejecucion no tuvo exito
                    $validaciones -> ejecucion = false;
                }         
            }
            else{ //si no se pudo realizar la consulta
                $validaciones -> consulta = false; 
            } 
            mysqli_close($conexion);      
            return json_encode($validaciones);//lo retornamos
        }//fin del else de la conexion
    }

?>