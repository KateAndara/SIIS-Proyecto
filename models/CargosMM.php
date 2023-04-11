<?php
    class CargosMM extends Conectar{

        public function get_CargosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_cargos";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
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
            $sql="INSERT INTO tbl_cargos(Nombre_cargo)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cargo);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_CargoMM($Id_Cargo,$Nombre_cargo){
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
            $sql = "DELETE FROM tbl_cargos WHERE Id_Cargo =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cargo);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?> 