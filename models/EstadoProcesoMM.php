<?php
    class EstadoProcesoMM extends Conectar{


        public function get_EstadoProcesosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_estado_proceso WHERE Estado = 'activo'";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function selectEstadoProceso($nombreTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_estado_proceso 
                    WHERE Descripcion =? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectEstadoProceso2($nombreTipo,$idEstadoProceso){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_estado_proceso 
                    WHERE Descripcion =? && Id_Estado_Proceso!=? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->bindValue(2, $idEstadoProceso);

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
        public function estadoeliminar($Id_Estado_Proceso){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Descripcion FROM tbl_estado_proceso WHERE Id_Estado_Proceso = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Estado_Proceso, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Descripcion'];
                    } else {
                        return "La pregunta con Id_Pregunta = $Id_Estado_Proceso no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        public function get_EstadoProcesoMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_proceso WHERE tbl_estado_proceso.Id_Estado_Proceso LIKE :busqueda OR
            tbl_estado_proceso.Descripcion LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_EstadoProcesoMMeditar($Id_Estado_Proceso){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_estado_proceso WHERE Id_Estado_Proceso=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Proceso);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_EstadoProcesoMM($Descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_estado_proceso(Descripcion, Estado)
            VALUES (?, 'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Descripcion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_EstadoProcesoMM($Descripcion,$Id_Estado_Proceso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_estado_proceso SET Descripcion=? WHERE Id_Estado_Proceso=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Descripcion);
            $sql->bindValue(2, $Id_Estado_Proceso);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_EstadoProcesoMM($Id_Estado_Proceso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_estado_proceso SET Estado = 'inactivo' WHERE Id_Estado_Proceso = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Proceso);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        } 
    }
?>