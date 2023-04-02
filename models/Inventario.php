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
                
        public function get_Inventario($busqueda){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT tbl_inventario.*, tbl_productos.Nombre 
                    FROM tbl_inventario
                    INNER JOIN tbl_productos 
                    ON tbl_inventario.Id_Producto = tbl_productos.Id_Producto 
                    WHERE tbl_inventario.Id_inventario LIKE :busqueda OR 
                          tbl_productos.Nombre LIKE :busqueda OR 
                          tbl_inventario.Existencia LIKE :busqueda OR";
        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }                
    }
?>