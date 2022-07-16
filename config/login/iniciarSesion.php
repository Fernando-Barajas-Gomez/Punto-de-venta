<?php

    //si es igual la llave ajax
    if(Peticion()) {   

        //revisamos que las variables esten colocadas
        if (isset($_REQUEST["usuario"]) && isset($_REQUEST["password"])) {

            //pasamos los datos para corroborarlos
            echo compararDatos($_REQUEST["usuario"], $_REQUEST["password"]);
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
    function compararDatos($usuario, $password){

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
            $consulta = $conexion->prepare("SELECT id, usuario FROM login WHERE usuario=? AND password=?;");       
            
            if($consulta){ //si se realizo con exito
                $validaciones -> consulta = true; 

                //colocamos los parametros
                $consulta->bind_param("ss", $usuario, $password);          
                
                if($consulta->execute()){  //si se ejecuto con exito la sentencia
                    $validaciones -> ejecucion = true;   

                    //obtenemos el resultado
                    $resultado = $consulta->get_result();

                    if(mysqli_num_rows($resultado)>0){ //si el usuario existe

                        $validaciones->usuario=true; 
                        $fila = mysqli_fetch_assoc($resultado); //obtenemos la fila del resultado            

                        //generamos una session para el usuario
                        session_start(); //iniciamos las sessiones
                        $_SESSION['usuario'] = $usuario; //nombre del usuario
                        $_SESSION['id'] = $fila["id"]; //id del usuario                                             
                    }
                    else{//si el usuario no existe
                        $validaciones->usuario=false;
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