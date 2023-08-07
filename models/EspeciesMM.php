<?php
    class EspeciesMM extends Conectar{

        public function get_EspeciesMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_especies";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
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

        public function especieeliminar($Id_Especie){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre_Especie FROM tbl_especies WHERE Id_Especie = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Especie, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre_Especie'];
                    } else {
                        return "La pregunta con Id_Pregunta = $Id_Especie no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        public function selectEspecie($nombreEspecie){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_especies 
                    WHERE Nombre_Especie =?"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreEspecie);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectEspecie2($nombreEspecie,$idEspecie){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_especies 
                    WHERE Nombre_Especie =? && Id_Especie!=?"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreEspecie);
            $sql->bindValue(2, $idEspecie);

            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_EspecieMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_especies WHERE tbl_especies.Id_Especie LIKE :busqueda OR
            tbl_especies.Nombre_Especie LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_EspecieMMeditar($Id_Especie){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_especies WHERE Id_Especie=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Especie);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_EspecieMM($Nombre_Especie){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_especies(Nombre_Especie)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Especie);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_EspecieMM($Nombre_Especie,$Id_Especie){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_especies SET Nombre_Especie=? WHERE Id_Especie=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Especie);
            $sql->bindValue(2, $Id_Especie);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_EspecieMM($Id_Especie){
            $conectar= parent::conexion();
            parent::set_names(); 
            $sql = "DELETE FROM tbl_especies WHERE Id_Especie =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Especie);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?> 