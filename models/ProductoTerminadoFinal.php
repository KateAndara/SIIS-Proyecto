<?php
    class ProductoTerminadoFinal extends Conectar{

        public function get_productosTerminadosFinal(){
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre 
                  FROM tbl_producto_terminado_final t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
                  WHERE t1.Id_Proceso_Produccion = (
                      SELECT MAX(Id_Proceso_Produccion) 
                      FROM tbl_proceso_produccion
                  )";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }        

        public function delete_productoTerminadoFinal($Id_Producto_Terminado_Final){
            $conectar= parent::conexion();
            parent::set_names();
            
            // Obtener el ID del producto en tbl_producto_terminado_final
            $sql_get_id_producto = "SELECT Id_Producto FROM tbl_producto_terminado_final WHERE Id_Producto_Terminado_Final = ?";
            $stmt_get_id_producto = $conectar->prepare($sql_get_id_producto);
            $stmt_get_id_producto->bindValue(1, $Id_Producto_Terminado_Final);
            $stmt_get_id_producto->execute();
            $id_producto = $stmt_get_id_producto->fetch(PDO::FETCH_ASSOC)['Id_Producto'];
        
            // Eliminar el registro en tbl_producto_terminado_mp
            $sql_delete_producto = "DELETE FROM tbl_producto_terminado_final WHERE Id_Producto_Terminado_Final = ?";
            $stmt_delete_producto = $conectar->prepare($sql_delete_producto);
            $stmt_delete_producto->bindvalue(1, $Id_Producto_Terminado_Final);
            $stmt_delete_producto->execute();
        
            // Eliminar el registro en tbl_kardex correspondiente al producto eliminado
            $sql_delete_kardex = "DELETE FROM tbl_kardex WHERE Id_Producto = ?";
            $stmt_delete_kardex = $conectar->prepare($sql_delete_kardex);
            $stmt_delete_kardex->bindvalue(1, $id_producto);
            $stmt_delete_kardex->execute();
        
            return $resultado=$stmt_delete_producto->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>