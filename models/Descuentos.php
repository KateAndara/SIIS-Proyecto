<?php
    class Descuentos extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_descuentos(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT Id_Descuento, Nombre_descuento, concat(Porcentaje_a_descontar,' ', '%') AS Porcentaje
                  FROM tbl_descuentos";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        /*public function get_productoTerminadoMP($Id_Producto_Terminado_Mp){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp WHERE Id_Producto_Terminado_Mp=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto_Terminado_Mp);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/
        
        public function get_descuento($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion();
            parent::set_names();
        
            // Verificar si la búsqueda es un número o una cadena
            if (is_numeric($busqueda)) {
                $sql = "SELECT Id_Descuento, Nombre_descuento, concat(Porcentaje_a_descontar,' ', '%') AS Porcentaje 
                        FROM tbl_descuentos  
                        WHERE Id_Descuento=?" ;
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            } else {
                $sql = "SELECT Id_Descuento, Nombre_descuento, concat(Porcentaje_a_descontar,' ', '%') AS Porcentaje 
                        FROM tbl_descuentos
                        WHERE Nombre_descuento=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            }
        
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_descuentoeditar($Id_Descuento){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_descuentos
                    WHERE Id_Descuento=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Descuento);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_descuento($Nombre_descuento, $Porcentaje_a_descontar){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_descuentos(Nombre_descuento, Porcentaje_a_descontar)
            VALUES (?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_descuento);
            $sql->bindValue(2, $Porcentaje_a_descontar);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_descuento($Id_Descuento, $Nombre_descuento, $Porcentaje_a_descontar){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_descuentos SET Nombre_descuento=?, Porcentaje_a_descontar=?WHERE Id_Descuento=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_descuento);
            $sql->bindValue(2, $Porcentaje_a_descontar);
            $sql->bindValue(3, $Id_Descuento);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_descuento($Id_Descuento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_descuentos WHERE Id_Descuento =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Descuento);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>