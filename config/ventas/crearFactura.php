<?php

    //si es igual la llave ajax
    if(Peticion()) {   
        //para obtener el id del usuario de la session
        session_start();
        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d H:i:s");

        echo crearFactura($_SESSION['id'], $fecha);
    } 
    else { //si no es igual la llave
        echo "Error.<br>La llave ingresada: ".$_SERVER['HTTP_X_REQUEST_WITH']."<br>No es valida";
    }

    /**  Función que revisa la peticion, que sea de tipo AJAX y checa que la llave sea igual*/
    function Peticion(){
        return isset($_SERVER['HTTP_X_REQUEST_WITH']) && $_SERVER['HTTP_X_REQUEST_WITH'] == 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5';
    }

    /** Funcion encargada de generar una nueva factura en la DB y devolver el id de la factura creada*/
    function crearFactura($idQuien, $fecha){

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
            $consulta = $conexion->prepare("INSERT INTO factura (idQuien, fecha) VALUES (?,?);");       
            
            if($consulta){ //si se realizo con exito
                $validaciones -> consulta = true; 

                //colocamos los parametros
                $consulta->bind_param("is", $idQuien, $fecha);          
                
                if($consulta->execute()){  //si se ejecuto con exito la sentencia
                    $validaciones -> ejecucion = true;   

                    //obtener el id del producto agregado
                    $consulta2 = $conexion->prepare("SELECT id FROM factura WHERE idQuien=? AND fecha=?;");
                    $consulta2->bind_param("is", $idQuien, $fecha); 
                    $consulta2->execute();   
                    $resultado=$consulta2->get_result();
                    $factura = mysqli_fetch_assoc($resultado);

                    $validaciones -> id = $factura['id'];
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