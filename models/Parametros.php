<?php
    class Parametro extends Conectar{

        public function get_parametros(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_ms_parametros";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
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
        public function get_parametro($busqueda){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_parametros 
            WHERE Id_Parametro LIKE :busqueda OR 
                  Parametro LIKE :busqueda OR 
                  Valor LIKE :busqueda";        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_parametroeditar($Id_Parametro){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_parametros 
                    WHERE Id_Parametro=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Parametro);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_parametro($Parametro, $Valor){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_ms_parametros(Parametro, Valor)
            VALUES (?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Parametro);
            $sql->bindValue(2, $Valor);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_parametro($Id_Parametro, $Parametro, $Valor){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_ms_parametros SET Parametro=?, Valor=? WHERE Id_Parametro=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Parametro);
            $sql->bindValue(2, $Valor);
            $sql->bindValue(3, $Id_Parametro);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_parametro($Id_Parametro){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_ms_parametros WHERE Id_Parametro =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Parametro);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>