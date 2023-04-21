<?php
session_start();
    class ProductoTerminadoMP extends Conectar{

        public function get_productosTerminadosMP(){
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre 
                  FROM tbl_producto_terminado_mp t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
                  WHERE t1.Id_Proceso_Produccion = (
                      SELECT MAX(Id_Proceso_Produccion) 
                      FROM tbl_proceso_produccion
                  )";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
        
        public function get_productosTerminadosMPEditandoProceso($id_proceso_produccion){
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre 
                  FROM tbl_producto_terminado_mp t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
                  WHERE t1.Id_Proceso_Produccion = (
                      SELECT Id_Proceso_Produccion FROM tbl_proceso_produccion WHERE Id_Proceso_Produccion = :id_proceso_produccion
                  )";
            $sql= $conexion->prepare($sql);
            $sql->bindParam(":id_proceso_produccion", $id_proceso_produccion, PDO::PARAM_INT);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        } 

        public function delete_productoTerminadoMP($Id_Producto_Terminado_Mp){
            $conectar= parent::conexion();
            parent::set_names();
        
            // Obtener el ID del producto en tbl_producto_terminado_mp
            $sql_get_id_producto = "SELECT Id_Producto FROM tbl_producto_terminado_mp WHERE Id_Producto_Terminado_Mp = ?";
            $stmt_get_id_producto = $conectar->prepare($sql_get_id_producto);
            $stmt_get_id_producto->bindValue(1, $Id_Producto_Terminado_Mp);
            $stmt_get_id_producto->execute();
            $id_producto = $stmt_get_id_producto->fetch(PDO::FETCH_ASSOC)['Id_Producto'];
        
            // Obtener la cantidad de producto eliminado
            $sql_get_cantidad_producto = "SELECT Cantidad FROM tbl_producto_terminado_mp WHERE Id_Producto_Terminado_Mp = ?";
            $stmt_get_cantidad_producto = $conectar->prepare($sql_get_cantidad_producto);
            $stmt_get_cantidad_producto->bindValue(1, $Id_Producto_Terminado_Mp);
            $stmt_get_cantidad_producto->execute();
            $cantidad_producto = $stmt_get_cantidad_producto->fetch(PDO::FETCH_ASSOC)['Cantidad'];
        
            // Actualizar la existencia en tbl_inventario
            $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $id_producto);
            $stmt_existencia->execute();
            $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
            $nueva_existencia = $existencia_actual + $cantidad_producto;
        
            $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
            $stmt_update_existencia = $conectar->prepare($sql_update_existencia);
            $stmt_update_existencia->bindValue(1, $nueva_existencia);
            $stmt_update_existencia->bindValue(2, $id_producto);
            $stmt_update_existencia->execute();
        
            // Agregar el registro en tbl_kardex
            $idPersona=$_SESSION['Id_Usuario'];
            $id_tipo_movimiento = 1;
        
            $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                            VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
            $stmt_kardex = $conectar->prepare($sql_kardex);
            $stmt_kardex->bindValue(1, $idPersona);
            $stmt_kardex->bindValue(2, $id_tipo_movimiento);
            $stmt_kardex->bindValue(3, $id_producto);
            $stmt_kardex->bindValue(4, $cantidad_producto);
            $stmt_kardex->execute();
        
            // Eliminar el registro en tbl_producto_terminado_mp
            $sql_delete_producto = "DELETE FROM tbl_producto_terminado_mp WHERE Id_Producto_Terminado_Mp = ?";
            $stmt_delete_producto = $conectar->prepare($sql_delete_producto);
            $stmt_delete_producto->bindvalue(1, $Id_Producto_Terminado_Mp);
            $stmt_delete_producto->execute();

            return $resultado=$stmt_delete_producto->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>