<?php
session_start();
    class ProcesoProduccion extends Conectar{

        public function insert_productoTerminadoMP($Id_Producto, $Cantidad){
            $conectar = parent::conexion();
            parent::set_names();
        
            // Obtener el último registro de la tabla "tbl_proceso_produccion"
            $sql_ultimo_proceso = "SELECT Id_Proceso_Produccion FROM tbl_proceso_produccion ORDER BY Id_Proceso_Produccion DESC LIMIT 1";
            $stmt_ultimo_proceso = $conectar->prepare($sql_ultimo_proceso);
            $stmt_ultimo_proceso->execute();
            $ultimo_proceso = $stmt_ultimo_proceso->fetch(PDO::FETCH_ASSOC);
            $id_ultimo_proceso = $ultimo_proceso['Id_Proceso_Produccion'];
        
            // Insertar el registro en tbl_producto_terminado_mp
            $sql_producto_terminado = "INSERT INTO tbl_producto_terminado_mp(Id_Producto, Id_Proceso_Produccion, Cantidad)
                    VALUES (?,?,?);";
            $stmt_producto_terminado = $conectar->prepare($sql_producto_terminado);
            $stmt_producto_terminado->bindValue(1, $Id_Producto);
            $stmt_producto_terminado->bindValue(2, $id_ultimo_proceso);
            $stmt_producto_terminado->bindValue(3, $Cantidad);
            $stmt_producto_terminado->execute();
        
            // Insertar el registro en tbl_kardex
            $idPersona=$_SESSION['Id_Usuario'];
            $id_tipo_movimiento = 2;

            $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                        VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
            $stmt_kardex = $conectar->prepare($sql_kardex);
            $stmt_kardex->bindValue(1, $idPersona);
            $stmt_kardex->bindValue(2, $id_tipo_movimiento);
            $stmt_kardex->bindValue(3, $Id_Producto);
            $stmt_kardex->bindValue(4, $Cantidad);
            $stmt_kardex->execute();

            // Actualizar la existencia en tbl_inventario
            $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $Id_Producto);
            $stmt_existencia->execute();
            $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
            $nueva_existencia = $existencia_actual - $Cantidad;

            $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
            $stmt_update_existencia = $conectar->prepare($sql_update_existencia);
            $stmt_update_existencia->bindValue(1, $nueva_existencia);
            $stmt_update_existencia->bindValue(2, $Id_Producto);
            $stmt_update_existencia->execute();

            return $resultado = $stmt_kardex->fetchAll(PDO::FETCH_ASSOC);

        }

        public function insert_productoTerminadoMPEditandoProceso($Id_Producto, $Cantidad, $idProceso){
            $conectar = parent::conexion();
            parent::set_names();
        
            // Insertar el registro en tbl_producto_terminado_mp
            $sql_producto_terminado = "INSERT INTO tbl_producto_terminado_mp(Id_Producto, Id_Proceso_Produccion, Cantidad)
                    VALUES (?,?,?);";
            $stmt_producto_terminado = $conectar->prepare($sql_producto_terminado);
            $stmt_producto_terminado->bindValue(1, $Id_Producto);
            $stmt_producto_terminado->bindValue(2, $idProceso);
            $stmt_producto_terminado->bindValue(3, $Cantidad);
            $stmt_producto_terminado->execute();
        
            // Insertar el registro en tbl_kardex
            $idPersona=$_SESSION['Id_Usuario'];
            $id_tipo_movimiento = 2;
        
            $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                        VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
            $stmt_kardex = $conectar->prepare($sql_kardex);
            $stmt_kardex->bindValue(1, $idPersona);
            $stmt_kardex->bindValue(2, $id_tipo_movimiento);
            $stmt_kardex->bindValue(3, $Id_Producto);
            $stmt_kardex->bindValue(4, $Cantidad);
            $stmt_kardex->execute();

            // Actualizar la existencia en tbl_inventario
            $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $Id_Producto);
            $stmt_existencia->execute();
            $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
            $nueva_existencia = $existencia_actual - $Cantidad;

            $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
            $stmt_update_existencia = $conectar->prepare($sql_update_existencia);
            $stmt_update_existencia->bindValue(1, $nueva_existencia);
            $stmt_update_existencia->bindValue(2, $Id_Producto);
            $stmt_update_existencia->execute();
        
            return $resultado = $stmt_kardex->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_productoTerminadoFinal($Id_Producto, $Cantidad){
            $conectar = parent::conexion();
            parent::set_names();
        
            // Obtener el último registro de la tabla "tbl_proceso_produccion"
            $sql_ultimo_proceso = "SELECT Id_Proceso_Produccion FROM tbl_proceso_produccion ORDER BY Id_Proceso_Produccion DESC LIMIT 1";
            $stmt_ultimo_proceso = $conectar->prepare($sql_ultimo_proceso);
            $stmt_ultimo_proceso->execute();
            $ultimo_proceso = $stmt_ultimo_proceso->fetch(PDO::FETCH_ASSOC);
            $id_ultimo_proceso = $ultimo_proceso['Id_Proceso_Produccion'];
        
            // Insertar el registro en tbl_producto_terminado_final
            $sql_producto_terminado = "INSERT INTO tbl_producto_terminado_final(Id_Producto, Id_Proceso_Produccion, Cantidad)
                    VALUES (?,?,?);";
            $stmt_producto_terminado = $conectar->prepare($sql_producto_terminado);
            $stmt_producto_terminado->bindValue(1, $Id_Producto);
            $stmt_producto_terminado->bindValue(2, $id_ultimo_proceso);
            $stmt_producto_terminado->bindValue(3, $Cantidad);
            $stmt_producto_terminado->execute();
        
            // Insertar el registro en tbl_kardex
            $idPersona=$_SESSION['Id_Usuario'];
            $id_tipo_movimiento = 1;

            $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                        VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
            $stmt_kardex = $conectar->prepare($sql_kardex);
            $stmt_kardex->bindValue(1, $idPersona);
            $stmt_kardex->bindValue(2, $id_tipo_movimiento);
            $stmt_kardex->bindValue(3, $Id_Producto);
            $stmt_kardex->bindValue(4, $Cantidad);
            $stmt_kardex->execute();

            // Actualizar la existencia en tbl_inventario
            $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $Id_Producto);
            $stmt_existencia->execute();
            $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
            $nueva_existencia = $existencia_actual + $Cantidad;

            $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
            $stmt_update_existencia = $conectar->prepare($sql_update_existencia);
            $stmt_update_existencia->bindValue(1, $nueva_existencia);
            $stmt_update_existencia->bindValue(2, $Id_Producto);
            $stmt_update_existencia->execute();

            return $resultado = $stmt_kardex->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_productoTerminadoFinalEditandoProceso($Id_Producto, $Cantidad, $idProceso){
            $conectar = parent::conexion();
            parent::set_names();
        
            // Insertar el registro en tbl_producto_terminado_final
            $sql_producto_terminado = "INSERT INTO tbl_producto_terminado_final(Id_Producto, Id_Proceso_Produccion, Cantidad)
                    VALUES (?,?,?);";
            $stmt_producto_terminado = $conectar->prepare($sql_producto_terminado);
            $stmt_producto_terminado->bindValue(1, $Id_Producto);
            $stmt_producto_terminado->bindValue(2, $idProceso);
            $stmt_producto_terminado->bindValue(3, $Cantidad);
            $stmt_producto_terminado->execute();
        
            // Insertar el registro en tbl_kardex
            $idPersona=$_SESSION['Id_Usuario'];
            $id_tipo_movimiento = 1;
        
            $sql_kardex = "INSERT INTO tbl_kardex(Id_Usuario, Id_Tipo_Movimiento, Id_Producto, Cantidad, Fecha_hora)
                        VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
            $stmt_kardex = $conectar->prepare($sql_kardex);
            $stmt_kardex->bindValue(1, $idPersona);
            $stmt_kardex->bindValue(2, $id_tipo_movimiento);
            $stmt_kardex->bindValue(3, $Id_Producto);
            $stmt_kardex->bindValue(4, $Cantidad);
            $stmt_kardex->execute();

            // Actualizar la existencia en tbl_inventario
            $sql_existencia = "SELECT Existencia FROM tbl_inventario WHERE Id_Producto = ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $Id_Producto);
            $stmt_existencia->execute();
            $existencia_actual = $stmt_existencia->fetch(PDO::FETCH_ASSOC)['Existencia'];
            $nueva_existencia = $existencia_actual + $Cantidad;

            $sql_update_existencia = "UPDATE tbl_inventario SET Existencia = ? WHERE Id_Producto = ?";
            $stmt_update_existencia = $conectar->prepare($sql_update_existencia);
            $stmt_update_existencia->bindValue(1, $nueva_existencia);
            $stmt_update_existencia->bindValue(2, $Id_Producto);
            $stmt_update_existencia->execute();
        
            return $resultado = $stmt_kardex->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_procesoProduccion($Id_Estado_Proceso, $Fecha){
            $conectar = parent::conexion();
            parent::set_names();
        
            // Formatear la fecha al formato yyyy-mm-dd
            $fechaFormateada = date("Y-m-d", strtotime(str_replace('/', '-', $Fecha)));
        
            $sql = "INSERT INTO tbl_proceso_produccion(Id_Estado_Proceso, Fecha)
                    VALUES (?,?);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $Id_Estado_Proceso);
            $sql->bindValue(2, $fechaFormateada); // Usar la fecha formateada
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        

        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_productosMP(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_productos WHERE Id_Tipo_Producto = 2"; //El "2" es porque el tipo de producto 2, es de materia prima.          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function validarCantidadDeMPEnInventario($Id_Producto, $Cantidad) {
            $conectar = parent::conexion();
            parent::set_names();
        
            // validar la existencia de materia prima en el inventario 
            $sql_existencia = "SELECT * FROM tbl_inventario WHERE Id_Producto = ? AND Existencia < ?";
            $stmt_existencia = $conectar->prepare($sql_existencia);
            $stmt_existencia->bindValue(1, $Id_Producto);
            $stmt_existencia->bindValue(2, $Cantidad);
            $stmt_existencia->execute();
            $resultado = $stmt_existencia->fetchAll(PDO::FETCH_ASSOC);
        
            return $resultado;
        }                     

        public function get_productosTerminados(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_productos WHERE Id_Tipo_Producto = 1"; //El "1" es porque el tipo de producto 1, es Terminado.          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_estadoProceso(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_proceso";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        //Bitácora 
       public function registrar_bitacora($id_usuario, $id_objeto, $accion, $descripcion) {
            $conexion = parent::Conexion();
            parent::set_names();
            
            $sql = "INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) 
                    VALUES (:id_usuario, :id_objeto, CURRENT_TIMESTAMP(), :accion, :descripcion)";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_objeto", $id_objeto, PDO::PARAM_INT);
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