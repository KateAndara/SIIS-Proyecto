<?php
    class Rol extends Conectar{

        public function get_roles(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_ms_roles";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
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

        public function insert_rol($Rol, $Descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_ms_roles(Rol, Descripcion)
            VALUES (?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Rol);
            $sql->bindValue(2, $Descripcion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
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

        public function delete_rol($Id_Rol){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_ms_roles WHERE Id_Rol =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Rol);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>