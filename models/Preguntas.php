<?php

    
    class Pregunta extends Conectar{

        public function get_preguntas(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_ms_preguntas";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
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
            $sql="INSERT INTO tbl_ms_preguntas(Pregunta)
            VALUES (?);";
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
            $sql = "DELETE FROM tbl_ms_preguntas WHERE Id_Pregunta =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Pregunta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>