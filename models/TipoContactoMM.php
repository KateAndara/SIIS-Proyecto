<?php
    class TipoContactoMM extends Conectar{

        public function get_TipoContactosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_contacto";   
            $sql = "SELECT * FROM tbl_tipo_contacto WHERE Estado = 'activo'";       
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function selectTipo($nombreTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_tipo_contacto 
                    WHERE Nombre_tipo_contacto =? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectTipo2($nombreTipo,$idTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_tipo_contacto 
                    WHERE Nombre_tipo_contacto =? && Id_Tipo_Contacto!=? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->bindValue(2, $idTipo);

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
        public function tipocontactoeliminar($Id_Tipo_Contacto){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre_tipo_contacto FROM tbl_tipo_contacto WHERE Id_Tipo_Contacto = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Tipo_Contacto, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre_tipo_contacto'];
                    } else {
                        return "La pregunta con Id_Pregunta = $Id_Tipo_Contacto no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        public function get_TipoContactoMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_contacto WHERE tbl_tipo_contacto.Id_Tipo_Contacto LIKE :busqueda OR
            tbl_tipo_contacto.Nombre_tipo_contacto LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_TipoContactoMMeditar($Id_Tipo_Contacto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_tipo_contacto WHERE Id_Tipo_Contacto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Contacto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_TipoContactoMM($Nombre_tipo_contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_tipo_contacto(Nombre_tipo_contacto, Estado)
            VALUES (?, 'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_tipo_contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_TipoContactoMM($Nombre_tipo_contacto,$Id_Tipo_Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_tipo_contacto SET Nombre_tipo_contacto=? WHERE Id_Tipo_Contacto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_tipo_contacto);
            $sql->bindValue(2, $Id_Tipo_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_TipoContactoMM($Id_Tipo_Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_tipo_contacto SET Estado = 'inactivo' WHERE Id_Tipo_Contacto = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>