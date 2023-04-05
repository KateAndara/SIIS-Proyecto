<?php
    class Inventario extends Conectar{
               
        public function get_Inventarios(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre 
                  FROM tbl_inventario t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
                           
    }
?>