<?php
    class Inventario extends Conectar{
               
        public function get_Inventarios(){                 
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.* 
                  FROM tbl_inventario t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function getMovimientos($idProducto){ 
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.* 
            FROM tbl_kardex t1                              
            JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto where t1.Id_Producto=$idProducto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
                            
    }
?>