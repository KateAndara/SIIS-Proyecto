<?php
session_start();
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

            // Agregar el registro en tbl_kardex
            $idPersona=$_SESSION['Id_Usuario'];
            $id_tipo_movimiento = 2;
        
            $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                            VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
            $stmt_kardex = $conectar->prepare($sql_kardex);
            $stmt_kardex->bindValue(1, $idPersona);
            $stmt_kardex->bindValue(2, $id_tipo_movimiento);
            $stmt_kardex->bindValue(3, $id_producto);
            $stmt_kardex->bindValue(4, $cantidad_producto);
            $stmt_kardex->execute();

            // Eliminar el registro en tbl_producto_terminado_final
            $sql_delete_producto = "DELETE FROM tbl_producto_terminado_final WHERE Id_Producto_Terminado_Final = ?";
            $stmt_delete_producto = $conectar->prepare($sql_delete_producto);
            $stmt_delete_producto->bindvalue(1, $Id_Producto_Terminado_Final);
            $stmt_delete_producto->execute();
        
            return $resultado=$stmt_delete_producto->fetchALL(PDO::FETCH_ASSOC);
        }

        public function cancelarProcesoProduccion($idProceso){
            $conexion= parent::Conexion();
            parent::set_names();
            $conexion->beginTransaction();
            try {
                
                $sql_get_productos_terminados = "SELECT Id_Producto_Terminado_Final, Id_Producto, Cantidad FROM tbl_producto_terminado_final WHERE Id_Proceso_Produccion = ?";
                $stmt_get_productos_terminados = $conexion->prepare($sql_get_productos_terminados);
                $stmt_get_productos_terminados->execute([$idProceso]);
                $productos_terminados = $stmt_get_productos_terminados->fetchAll(PDO::FETCH_ASSOC);

                foreach ($productos_terminados as $producto_terminado) {
                    // Obtener los datos del producto terminado
                    $id_producto_terminado = $producto_terminado['Id_Producto_Terminado_Final'];
                    $id_producto = $producto_terminado['Id_Producto'];
                    $cantidad_producto = $producto_terminado['Cantidad'];
                
                    // Actualizar la existencia en tbl_inventario
                    $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
                    $stmt_existencia = $conexion->prepare($sql_existencia);
                    $stmt_existencia->bindValue(1, $id_producto);
                    $stmt_existencia->execute();
                    $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
                    $nueva_existencia = $existencia_actual - $cantidad_producto;
                
                    $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
                    $stmt_update_existencia = $conexion->prepare($sql_update_existencia);
                    $stmt_update_existencia->bindValue(1, $nueva_existencia);
                    $stmt_update_existencia->bindValue(2, $id_producto);
                    $stmt_update_existencia->execute();
                
                    // Agregar el registro en tbl_kardex
                    $idPersona=$_SESSION['Id_Usuario'];
                    $id_tipo_movimiento = 2;
                
                    $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                                    VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
                    $stmt_kardex = $conexion->prepare($sql_kardex);
                    $stmt_kardex->bindValue(1, $idPersona);
                    $stmt_kardex->bindValue(2, $id_tipo_movimiento);
                    $stmt_kardex->bindValue(3, $id_producto);
                    $stmt_kardex->bindValue(4, $cantidad_producto);
                    $stmt_kardex->execute();
                }
                
                // Eliminar los productos terminados
                $sql_eliminar_producto = "DELETE FROM tbl_producto_terminado_final WHERE Id_Proceso_Produccion = ?";
                $stmt_eliminar_producto = $conexion->prepare($sql_eliminar_producto);
                $stmt_eliminar_producto->execute([$idProceso]);
                
                // Actualizar el estado del proceso de producción
                $sql_actualizar_proceso = "UPDATE tbl_proceso_produccion SET Id_Estado_Proceso = '3' WHERE Id_Proceso_Produccion = ?";
                $stmt_actualizar_proceso = $conexion->prepare($sql_actualizar_proceso);
                $stmt_actualizar_proceso->execute([$idProceso]);
                
                $conexion->commit();
                return true;
            } catch (PDOException $e) {
                $conexion->rollback();
                return false;
            }
        }
        //Bitácora 
        public function registrar_bitacora($id_usuario, $id_objeto, $accion, $descripcion){
            $conexion= parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) 
                  VALUES (:id_usuario, :id_objeto, :fecha, :accion, :descripcion)";
            $stmt= $conexion->prepare($sql);
            $fecha = date("Y-m-d H:i:s");
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_objeto", $id_objeto, PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $stmt->bindParam(":accion", $accion, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->execute();
        }
        public function get_user($user){
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = ?";
            $stmt = $conexion->prepare($sql);
            if ($stmt) {
                $stmt->bindValue(1, $user, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado['Id_Usuario'];
            } else {
                return null;
            }
        }  
    }
?>