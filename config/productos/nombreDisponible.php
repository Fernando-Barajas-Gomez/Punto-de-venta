<?php

    //si es igual la llave ajax
    if(Peticion()) {   

        //revisamos que las variables esten colocadas
        if (isset($_REQUEST["nombre"])) {

            //pasamos los datos para corroborarlos
            echo nombreDisponible($_REQUEST["nombre"]);
        }
    } 
    else { //si no es igual la llave
        echo "Error.<br>La llave ingresada: ".$_SERVER['HTTP_X_REQUEST_WITH']."<br>No es valida";
    }

    /**  Función que revisa la peticion, que sea de tipo AJAX y checa que la llave sea igual*/
    function Peticion(){
        return isset($_SERVER['HTTP_X_REQUEST_WITH']) && $_SERVER['HTTP_X_REQUEST_WITH'] == 'bo48NKV7QO6ytRloRKE6KZTKt7rygR8kcmLDhoZozUVwXx1hoNFdRVnRU4Q0VlY5';
    }

    /** Funcion encargada de comparar los datos con la base de datos y retornar si existe o no*/
    function nombreDisponible($nombre){

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
            $consulta = $conexion->prepare("SELECT id FROM productos WHERE nombre=?;");       
            
            if($consulta){ //si se realizo con exito
                $validaciones -> consulta = true; 

                //colocamos los parametros
                $consulta->bind_param("s", $nombre);          
                
                if($consulta->execute()){  //si se ejecuto con exito la sentencia
                    $validaciones -> ejecucion = true;   

                    //obtenemos el resultado
                    $resultado = $consulta->get_result();

                    if(mysqli_num_rows($resultado)>0){ //si el nombre existe

                        $validaciones->existe=true;                                              
                    }
                    else{//si el nombre no existe
                        $validaciones->existe=false;
                    }
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