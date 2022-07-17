<?php
    class consultas{
        /**Metodo que retorna todas los productos de la base de datos */
        public function productos(){

            //archivo con la conexion
            require_once 'conexion.php';
            $conexion=conexion(); //generamos la conexion

            if(!$conexion){ //sino se establecio con exito mostramos el error
                printf("Fallo la conexion MySQL con el error: %s", mysqli_connect_error());
                exit;
            }
            else{
                $consulta = $conexion->prepare("SELECT * FROM productos;");       
                if($consulta){        
                    if($consulta->execute()){  
                            return $consulta->get_result(); //retornamos los productos
                    }
                    else{
                        return false;
                    }         
                }
                else{ //si no se pudo realizar la consulta
                    return false;
                }   
            }
            mysqli_close($conexion); //cerramos la conexion
        }

        /**Metodo que retorna todas las facturas de la base de datos */
        public function facturas(){

            //archivo con la conexion
            require_once 'conexion.php';
            $conexion=conexion(); //generamos la conexion

            if(!$conexion){ //sino se establecio con exito mostramos el error
                printf("Fallo la conexion MySQL con el error: %s", mysqli_connect_error());
                exit;
            }
            else{
                $consulta = $conexion->prepare("SELECT factura.*, login.usuario FROM factura, login WHERE factura.idQuien=login.id;");       
                if($consulta){        
                    if($consulta->execute()){  
                            return $consulta->get_result(); //retornamos las facturas
                    }
                    else{
                        return false;
                    }         
                }
                else{ //si no se pudo realizar la consulta
                    return false;
                }   
            }
            mysqli_close($conexion); //cerramos la conexion
        }

        /**Metodo que retorna todos los productos de cierta factura*/
        public function productosFactura($id){

            //archivo con la conexion
            require_once 'conexion.php';
            $conexion=conexion(); //generamos la conexion

            if(!$conexion){ //sino se establecio con exito mostramos el error
                printf("Fallo la conexion MySQL con el error: %s", mysqli_connect_error());
                exit;
            }
            else{
                $consulta = $conexion->prepare("SELECT f.*, f.id AS idFactura, 
                                                        v.*, v.id AS idVenta, 
                                                        p.*, p. id AS  idProducto
                                                        l.*,l
                                                FROM factura AS f , login AS l, productos AS p, ventas AS v
                                                WHERE factura.idQuien=login.id;");       
                if($consulta){        
                    if($consulta->execute()){  
                            return $consulta->get_result(); //retornamos las facturas
                    }
                    else{
                        return false;
                    }         
                }
                else{ //si no se pudo realizar la consulta
                    return false;
                }   
            }
            mysqli_close($conexion); //cerramos la conexion
        }
    }//fin de la clase
?>