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
        
        public function get_productosTerminadosFinalEditandoProceso($id_proceso_produccion){
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre 
                  FROM tbl_producto_terminado_final t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
                  WHERE t1.Id_Proceso_Produccion = (
                      SELECT Id_Proceso_Produccion FROM tbl_proceso_produccion WHERE Id_Proceso_Produccion = :id_proceso_produccion
                  )";
            $sql= $conexion->prepare($sql);
            $sql->bindParam(":id_proceso_produccion", $id_proceso_produccion, PDO::PARAM_INT);
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
        
            // Obtener la cantidad de producto eliminado
            $sql_get_cantidad_producto = "SELECT Cantidad FROM tbl_producto_terminado_final WHERE Id_Producto_Terminado_Final = ?";
            $stmt_get_cantidad_producto = $conectar->prepare($sql_get_cantidad_producto);
            $stmt_get_cantidad_producto->bindValue(1, $Id_Producto_Terminado_Final);
            $stmt_get_cantidad_producto->execute();
            $cantidad_producto = $stmt_get_cantidad_producto->fetch(PDO::FETCH_ASSOC)['Cantidad'];

            // Actualizar la existencia en tbl_inventario
            $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $id_producto);
            $stmt_existencia->execute();
            $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
            $nueva_existencia = $existencia_actual - $cantidad_producto;

            $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
            $stmt_update_existencia = $conectar->prepare($sql_update_existencia);
            $stmt_update_existencia->bindValue(1, $nueva_existencia);
            $stmt_update_existencia->bindValue(2, $id_producto);
            $stmt_update_existencia->execute();

            // Eliminar el registro en tbl_producto_terminado_final
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