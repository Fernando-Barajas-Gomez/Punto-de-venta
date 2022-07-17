<?php

    //si es igual la llave ajax
    if(Peticion()) {   

        //revisamos que las variables esten colocadas
        if(isset($_REQUEST["nombre"]) && isset($_REQUEST["descripcion"]) && isset($_REQUEST["precio"])) {

            //pasamos los datos para corroborarlos
            echo agregarProducto($_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["precio"]);
        }
    } 
    else { //si no es igual la llave
        echo "Error.<br>La llave ingresada: ".$_SERVER['HTTP_X_REQUEST_WITH']."<br>No es valida";
    }

    /**  Función que revisa la peticion, que sea de tipo AJAX y checa que la llave sea igual*/
    function Peticion(){
        return isset($_SERVER['HTTP_X_REQUEST_WITH']) && $_SERVER['HTTP_X_REQUEST_WITH'] == 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5';
    }

    /** Funcion encargada de insertar el nuevo producto en la DB y devolver el id del producto agregado*/
    function agregarProducto($nombre, $descripcion, $precio){

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
            $consulta = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?,?,?);");       
            
            if($consulta){ //si se realizo con exito
                $validaciones -> consulta = true; 

                //colocamos los parametros
                $consulta->bind_param("ssi", $nombre, $descripcion, $precio);          
                
                if($consulta->execute()){  //si se ejecuto con exito la sentencia
                    $validaciones -> ejecucion = true;   

                    //obtener el id del producto agregado
                    $consulta2 = $conexion->prepare("SELECT id FROM productos WHERE nombre=? AND precio=?;");
                    $consulta2->bind_param("si", $nombre, $precio); 
                    $consulta2->execute();   
                    $resultado=$consulta2->get_result();
                    $producto = mysqli_fetch_assoc($resultado);

                    $validaciones -> id = $producto['id'];
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