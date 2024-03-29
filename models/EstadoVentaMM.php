<?php
    class EstadoVentaMM extends Conectar{

        public function get_EstadosVentaMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_estado_venta WHERE Estado = 'activo'";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function selectEstadoVenta($nombreEstado){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_estado_venta 
                    WHERE Nombre_estado =? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreEstado);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectEstadoVenta2($nombreEstado,$idEstadoVenta){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_estado_venta 
                    WHERE Nombre_estado =? && Id_Estado_Venta!=? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreEstado);
            $sql->bindValue(2, $idEstadoVenta);

            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
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
        public function estadodeventaeliminar($Id_Estado_Venta){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre_estado FROM tbl_estado_venta WHERE Id_Estado_Venta = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Estado_Venta, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre_estado'];
                    } else {
                        return "El Estado de Venta con Id_Estado_Venta = $Id_Estado_Venta no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        public function get_EstadoVentaMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_venta WHERE tbl_estado_venta.Id_Estado_Venta LIKE :busqueda OR
            tbl_estado_venta.Nombre_estado LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_EstadoVentaMMeditar($Id_Estado_Venta){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_estado_venta WHERE Id_Estado_Venta=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Venta);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_EstadoVentaMM($Nombre_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_estado_venta(Nombre_estado, Estado)
            VALUES (?, 'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_estado);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_EstadoVentaMM($Nombre_estado,$Id_Estado_Venta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_estado_venta SET Nombre_estado=? WHERE Id_Estado_Venta=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_estado);
            $sql->bindValue(2, $Id_Estado_Venta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_EstadoVentaMM($Id_Estado_Venta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_estado_venta SET Estado = 'inactivo' WHERE Id_Estado_Venta = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Venta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?>
