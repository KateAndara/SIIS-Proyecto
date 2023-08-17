<?php
    class Kardex extends Conectar{

        public function get_Kardexs() {
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT t1.*, t2.Nombre, t3.Descripcion, t4.Usuario 
            FROM tbl_kardex t1 
            JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto 
            JOIN tbl_tipo_movimiento t3 ON t1.Id_Tipo_Movimiento = t3.Id_Tipo_Movimiento 
            JOIN tbl_ms_usuarios t4 ON t1.Id_Usuario = t4.Id_Usuario 
            ORDER BY t1.Fecha_hora DESC";
            $sql = $conexion->prepare($sql);
            $sql->execute();
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            // Formatear la fecha en cada resultado

            foreach ($resultados as &$resultado) {

                $fecha_dt = new DateTime($resultado['Fecha_hora']);  
                $fecha_dt->setTimezone(new DateTimeZone('America/Tegucigalpa'));
                $fecha_formateada = $fecha_dt->format('d-m-Y');
                $resultado['Fecha_hora'] = $fecha_formateada;
            }
                return $resultados;
        }  
        
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