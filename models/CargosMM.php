<?php
    class CargosMM extends Conectar{

        public function get_CargosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            //$sql="SELECT * FROM tbl_cargos";      
            $sql = "SELECT * FROM tbl_cargos WHERE Estado = 'activo'";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
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
        public function cargoeliminar($Id_Cargo){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre_cargo FROM tbl_cargos WHERE Id_Cargo = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Cargo, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre_cargo'];
                    } else {
                        return "El cargo  con Id_Cargo = $Id_Cargo no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public function selectCargo($nombreCargo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_cargos 
                    WHERE Nombre_cargo =? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreCargo);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectCargo2($nombreCargo,$idCargo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_cargos 
                    WHERE Nombre_cargo =? && Id_Cargo!=? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreCargo);
            $sql->bindValue(2, $idCargo);

            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_CargoMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_cargos WHERE tbl_cargos.Id_Cargo LIKE :busqueda OR
            tbl_cargos.Nombre_cargo LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_CargoMMeditar($Id_Cargo){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_cargos WHERE Id_Cargo=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cargo);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_CargoMM($Nombre_cargo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_cargos(Nombre_cargo, Estado)
            VALUES (?,'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cargo);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_CargoMM($Nombre_cargo,$Id_Cargo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_cargos SET Nombre_cargo=? WHERE Id_Cargo=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cargo);
            $sql->bindValue(2, $Id_Cargo);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_CargoMM($Id_Cargo){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql = "DELETE FROM tbl_cargos WHERE Id_Cargo =?";
            $sql = "UPDATE tbl_cargos SET Estado = 'inactivo' WHERE Id_Cargo = ?";

            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cargo);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?> 