<?php
    class Promociones extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_promociones(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * 
                  FROM tbl_promociones";
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
        
        public function get_promocion($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion();
            parent::set_names();
        
            // Verificar si la búsqueda es un número o una cadena
            if (is_numeric($busqueda)) {
                $sql = "SELECT * 
                        FROM tbl_promociones  
                        WHERE Id_Promocion=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            } else {
                $sql = "SELECT * 
                        FROM tbl_promociones
                        WHERE Nombre_Promocion=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            }
        
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_promocioneditar($Id_Promocion){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_promociones
                    WHERE Id_Promocion=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_promocion($Nombre_Promocion, $Precio_Venta, $Fecha_inicio, $Fecha_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_promociones(Nombre_Promocion, Precio_Venta, Fecha_inicio, Fecha_final)
            VALUES (?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Promocion);
            $sql->bindValue(2, $Precio_Venta);
            $sql->bindValue(3, $Fecha_inicio);
            $sql->bindValue(4, $Fecha_final);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_promocion($Id_Promocion, $Nombre_Promocion, $Precio_Venta, $Fecha_inicio, $Fecha_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_promociones SET Nombre_Promocion=?, Precio_Venta=?, Fecha_inicio=?, Fecha_final=? WHERE Id_Promocion=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Promocion);
            $sql->bindValue(2, $Precio_Venta);
            $sql->bindValue(3, $Fecha_inicio);
            $sql->bindValue(4, $Fecha_final);
            $sql->bindValue(5, $Id_Promocion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_promocion($Id_Promocion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_promociones WHERE Id_Promocion =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>