<?php
    class Usuarios extends Conectar{

        public function get_Usuarios(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT u.*, r.Rol 
            FROM `tbl_ms_usuarios` u 
            INNER JOIN tbl_ms_roles r ON u.Id_Rol = r.Id_Rol 
            WHERE u.Estado != 'Eliminado';";         
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
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

        public function getRoles(){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_ms_roles WHERE Estado = 'activo'";       
            $sql = $conectar->prepare($sql);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCargos(){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_cargos;";       
            $sql = $conectar->prepare($sql);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getUsuarioEditar($Id_Usuario){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol,c.Nombre_cargo FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol INNER JOIN tbl_cargos c on u.Id_Cargo = c.Id_Cargo WHERE Id_Usuario=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Usuario);
            $sql->execute();
            return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        }


        public function verficaDNI($DNI){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol WHERE u.DNI=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $DNI);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function verificarUsuario($usuario){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol WHERE u.Usuario=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $usuario);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function verificarCorreo($correo){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol WHERE u.Correo_Electronico=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $correo);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function verficaDNI2($DNI,$id_Usuario){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol WHERE u.DNI=? and u.Id_Usuario!=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $DNI);
            $sql->bindvalue(2, $id_Usuario);

            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function verificarUsuario2($usuario,$id_Usuario){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol WHERE u.Usuario=?  and u.Id_Usuario!=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $usuario);
            $sql->bindvalue(2, $id_Usuario);

            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function verificarHistorialContrasenia($contraseña, $id_Usuario) {
            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql = "SELECT * FROM `tbl_ms_hist_contraseña` WHERE Id_Usuario = ? AND Contraseña = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $id_Usuario);
            $sql->bindvalue(2, $contraseña);
        
            $sql->execute();
            
            return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        }
        
        public function verificarCorreo2($correo,$id_Usuario){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT u.*,r.Rol FROM `tbl_ms_usuarios` u INNER JOIN tbl_ms_roles r on u.Id_Rol = r.Id_Rol WHERE u.Correo_Electronico=? and u.Id_Usuario!=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $correo);
            $sql->bindvalue(2, $id_Usuario);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        public function insert_Usuario($usuario, $nombre, $estado, $DNI, $correo, $contrasena, $rolSelect, $rolCargo, $fechaVencimiento, $CreadoPor) {
            $conectar = parent::conexion();
            parent::set_names();
            
            $sql = "INSERT INTO `tbl_ms_usuarios` (`Id_Rol`, `Id_Cargo`, `Usuario`, `Nombre`, `Estado`, `Contraseña`, `Fecha_ultima_conexion`, `Preguntas_contestadas`, `Primer_ingreso`, `Fecha_vencimiento`, `DNI`, `Correo_Electronico`, `Creado_por`, `Fecha_creacion`, `Modificado_por`, `Fecha_modificacion`) 
                    VALUES (?, ?, ?, ?, ?, ?, NULL, NULL, NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP(), NULL, NULL);";
            
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $rolSelect);
            $sql->bindValue(2, $rolCargo);
            $sql->bindValue(3, $usuario);
            $sql->bindValue(4, $nombre);
            $sql->bindValue(5, "Nuevo");
            $sql->bindValue(6, $contrasena);
            $sql->bindValue(7, $fechaVencimiento);
            $sql->bindValue(8, $DNI);
            $sql->bindValue(9, $correo);
            $sql->bindValue(10, $CreadoPor);
            $sql->execute();
            
            $idUsuarioInsertado = $conectar->lastInsertId();
            
            // Insertar en tbl_ms_hist_contraseña
            $sqlHistContraseña = "INSERT INTO `tbl_ms_hist_contraseña` (`Id_Usuario`, `Contraseña`, `Creado_por`, `Fecha_creacion`) 
                                  VALUES (?, ?, ?, CURRENT_TIMESTAMP());";
            $sqlHistContraseña = $conectar->prepare($sqlHistContraseña);
            $sqlHistContraseña->bindValue(1, $idUsuarioInsertado);
            $sqlHistContraseña->bindValue(2, $contrasena);
            $sqlHistContraseña->bindValue(3, $CreadoPor);
            $sqlHistContraseña->execute();
            
            return $idUsuarioInsertado;
        }
        

        public function update_Usuario($usuario, $nombre, $estado, $DNI, $correo, $contrasena, $rolSelect, $rolCargo, $fechaVencimiento, $modificadoPor, $id_Usuario){
            $conectar = parent::conexion();
            parent::set_names();

            // Verificar el número de contraseñas en el historial
            $sqlCount = "SELECT COUNT(*) as total FROM `tbl_ms_hist_contraseña` WHERE `Id_Usuario` = ?";
            $sqlCountStmt = $conectar->prepare($sqlCount);
            $sqlCountStmt->bindValue(1, $id_Usuario);
            $sqlCountStmt->execute();
            $totalContraseñas = $sqlCountStmt->fetch(PDO::FETCH_ASSOC)['total'];

            if ($totalContraseñas >= 10) {
                // Eliminar la contraseña más antigua del historial
                $sqlDeleteOldest = "DELETE FROM `tbl_ms_hist_contraseña` WHERE `Id_Usuario` = ? ORDER BY `Fecha_modificacion` ASC LIMIT 1";
                $sqlDeleteStmt = $conectar->prepare($sqlDeleteOldest);
                $sqlDeleteStmt->bindValue(1, $id_Usuario);
                $sqlDeleteStmt->execute();
            }

            // Insertar la nueva contraseña en el historial
            $sqlHistContraseña = "INSERT INTO `tbl_ms_hist_contraseña` (`Id_Usuario`, `Contraseña`, `Modificado_por`, `Fecha_modificacion`) 
            VALUES (?, ?, ?, CURRENT_TIMESTAMP());";
            $sqlInsertHistContraseña = $conectar->prepare($sqlHistContraseña);
            $sqlInsertHistContraseña->bindValue(1, $id_Usuario);
            $sqlInsertHistContraseña->bindValue(2, $contrasena);
            $sqlInsertHistContraseña->bindValue(3, $modificadoPor);
            $sqlInsertHistContraseña->execute();

            // Actualizar los demás datos del usuario
            $sql = "UPDATE `tbl_ms_usuarios` SET `Id_Rol` = ?, `Id_Cargo` = ?, `Usuario` = ?, `Nombre` = ?, `Estado` = ?, `Contraseña` = ?, `Fecha_vencimiento` = ?, `DNI` = ?, `Correo_Electronico` = ?, `Modificado_por` = ?, `Fecha_modificacion` = CURRENT_TIMESTAMP()  WHERE `tbl_ms_usuarios`.`Id_Usuario` = ?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $rolSelect);
            $sql->bindValue(2, $rolCargo);
            $sql->bindValue(3, $usuario);
            $sql->bindValue(4, $nombre);
            $sql->bindValue(5, $estado);
            $sql->bindValue(6, $contrasena);
            $sql->bindValue(7, $fechaVencimiento);
            $sql->bindValue(8, $DNI);
            $sql->bindValue(9, $correo);
            $sql->bindValue(10, $modificadoPor);
            $sql->bindValue(11, $id_Usuario);
            $sql->execute();

            return $resultado = $sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_Usuario2($usuario,$nombre,$estado,$DNI,$correo,$rolSelect,$rolCargo,$fechaVencimiento,$modificadoPor,$id_Usuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE `tbl_ms_usuarios` SET `Id_Rol` = ?, `Id_Cargo` = ?, `Usuario` = ?, `Nombre` = ?, `Estado` = ?,`Fecha_vencimiento`=?, `DNI` = ?, `Correo_Electronico` = ?,`Modificado_por` = ?, `Fecha_modificacion` =CURRENT_TIMESTAMP()  WHERE `tbl_ms_usuarios`.`Id_Usuario` = ?;";


            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $rolSelect);
            $sql->bindValue(2, $rolCargo);

            $sql->bindValue(3, $usuario);
            $sql->bindValue(4, $nombre);
            $sql->bindValue(5, $estado);

            $sql->bindValue(6, $fechaVencimiento);
            $sql->bindValue(7, $DNI);
            $sql->bindValue(8, $correo);
            $sql->bindValue(9, $modificadoPor);
            $sql->bindValue(10, $id_Usuario);


            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function delete_rol($idUsuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE `tbl_ms_usuarios` SET `Estado` = ? WHERE `tbl_ms_usuarios`.`Id_Usuario` = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, "Eliminado");
            $sql->bindvalue(2, $idUsuario);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function usuarioeliminar($id_Usuario){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Usuario FROM tbl_ms_usuarios WHERE Id_Usuario = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $id_Usuario, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Usuario'];
                    } else {
                        return "El usuario con Id_Usuario = $id_Usuario no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }
?>