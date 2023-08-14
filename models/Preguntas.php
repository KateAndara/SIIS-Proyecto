<?php

    
    class Pregunta extends Conectar{

        public function get_preguntas(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_ms_preguntas WHERE Estado = 'activo' ";          
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
        public function get_pregunta($busqueda){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_preguntas 
                    WHERE Id_Pregunta LIKE :busqueda OR 
                          Pregunta LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function preguntaeliminar($Id_Pregunta){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Pregunta FROM tbl_ms_preguntas WHERE Id_Pregunta = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Pregunta, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Pregunta'];
                    } else {
                        return "La pregunta con Id_Pregunta = $Id_Pregunta no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        public function get_preguntaeditar($Id_Pregunta){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_ms_preguntas 
                    WHERE Id_Pregunta=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Pregunta);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_pregunta($Pregunta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_ms_preguntas(Pregunta, Estado)
            VALUES (?, 'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Pregunta);
            $sql->execute();

            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_pregunta($Id_Pregunta, $Pregunta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_ms_preguntas SET Pregunta=? WHERE Id_Pregunta=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Pregunta);
            $sql->bindValue(2, $Id_Pregunta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_pregunta($Id_Pregunta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_ms_preguntas SET Estado = 'inactivo' WHERE Id_Pregunta = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Pregunta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
       

    }
?>