<?php
    class EstadoProcesoMM extends Conectar{


        public function get_EstadoProcesosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_proceso";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
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
            $sql="INSERT INTO tbl_estado_proceso(Descripcion)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Descripcion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_EstadoProcesoMM($Id_Estado_Proceso,$Descripcion){
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
            $sql = "DELETE FROM tbl_estado_proceso WHERE Id_Estado_Proceso =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Proceso);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        } 
    }
?>