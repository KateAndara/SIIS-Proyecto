<?php
    class ProductoTerminadoMP extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_productosTerminadosMP(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre 
                  FROM tbl_producto_terminado_mp t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto";
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
        
        public function get_productoTerminadoMP($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion();
            parent::set_names();
        
            // Verificar si la búsqueda es un número o una cadena
            if (is_numeric($busqueda)) {
                $sql = "SELECT tbl_producto_terminado_mp.*, tbl_productos.Nombre 
                        FROM tbl_producto_terminado_mp 
                        INNER JOIN tbl_productos 
                        ON tbl_producto_terminado_mp.Id_Producto = tbl_productos.Id_Producto 
                        WHERE tbl_producto_terminado_mp.Id_Producto_Terminado_Mp=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            } else {
                $sql = "SELECT tbl_producto_terminado_mp.*, tbl_productos.Nombre 
                        FROM tbl_producto_terminado_mp 
                        INNER JOIN tbl_productos 
                        ON tbl_producto_terminado_mp.Id_Producto = tbl_productos.Id_Producto 
                        WHERE tbl_productos.Nombre=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            }
        
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_productoTerminadoMPeditar($Id_Producto_Terminado_Mp){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_producto_terminado_mp.*, tbl_productos.Nombre 
                    FROM tbl_producto_terminado_mp 
                    INNER JOIN tbl_productos 
                    ON tbl_producto_terminado_mp.Id_Producto = tbl_productos.Id_Producto 
                    WHERE tbl_producto_terminado_mp.Id_Producto_Terminado_Mp=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto_Terminado_Mp);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_productoTerminadoMP($Id_Producto, $Id_Proceso_Produccion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_producto_terminado_mp(Id_Producto, Id_Proceso_Produccion, Cantidad)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Proceso_Produccion);
            $sql->bindValue(3, $Cantidad);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_productoTerminadoMP($Id_Producto_Terminado_Mp, $Id_Producto, $Id_Proceso_Produccion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_producto_terminado_mp SET Id_Producto=?, Id_Proceso_Produccion=?, Cantidad=? WHERE Id_Producto_Terminado_Mp=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Proceso_Produccion);
            $sql->bindValue(3, $Cantidad);
            $sql->bindValue(4, $Id_Producto_Terminado_Mp);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_productoTerminadoMP($Id_Producto_Terminado_Mp){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_producto_terminado_mp WHERE Id_Producto_Terminado_Mp =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto_Terminado_Mp);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>