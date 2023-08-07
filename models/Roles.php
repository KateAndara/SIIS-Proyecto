<?php
    class Rol extends Conectar{

        public function get_roles() {
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_roles WHERE Estado = 'activo'";
            $sql = $conexion->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_rol($busqueda){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_ms_roles 
                    WHERE Id_Rol LIKE :busqueda OR 
                          Rol LIKE :busqueda OR 
                          Descripcion LIKE :busqueda";        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
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
        public function get_roleditar($Id_Rol){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_roles
                    WHERE Id_Rol=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Rol);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function roleliminar($Id_Rol){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Rol FROM tbl_ms_roles WHERE Id_Rol = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Rol, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Rol'];
                    } else {
                        return "El rol con Id_Rol = $Id_Rol no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public function insert_rol($Rol, $Descripcion) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tbl_ms_roles(Rol, Descripcion, Estado)
                    VALUES (?, ?, 'activo');"; // Aquí agregamos 'activo' como valor por defecto para el campo 'Estado'.
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $Rol);
            $sql->bindValue(2, $Descripcion);
            $sql->execute();
            return true; // O cualquier otra respuesta que desees devolver para indicar que el registro fue insertado correctamente.
        }
        

        public function update_rol($Id_Rol, $Rol, $Descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_ms_roles SET Rol=?, Descripcion=? WHERE Id_Rol=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Rol);
            $sql->bindValue(2, $Descripcion);
            $sql->bindValue(3, $Id_Rol);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_rol($Id_Rol) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_ms_roles SET Estado = 'inactivo' WHERE Id_Rol = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Rol);
            $sql->execute();
            return true; // O cualquier otra respuesta que desees devolver para indicar que el registro fue marcado como inactivo.
        }



        //Permisos


        public function selectModulos(){       
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_objetos where Tipo_objeto='Permiso'";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectRol($idRol){       
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_roles WHERE Id_Rol=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $idRol);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectPermisosRol($idRol){       
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM `tbl_permisos` WHERE `Id_Rol`=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $idRol);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deletePermisos($idRol)
        {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_permisos WHERE `Id_Rol`=?";
            $sql = $conectar->prepare($sql);
       
            $sql->bindvalue(1, $idRol);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d)
        {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "INSERT INTO `tbl_permisos` (`Id_Rol`, `Id_Objeto`, `Permiso_insercion`, `Permiso_eliminacion`, `Permiso_actualizacion`, `Permiso_consultar`) VALUES (?, ?, ?, ?, ?, ?);";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $intIdrol);
            $sql->bindvalue(2, $idModulo);
            $sql->bindvalue(3, $w);
            $sql->bindvalue(4, $d);
            $sql->bindvalue(5, $u);
            $sql->bindvalue(6, $r);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>