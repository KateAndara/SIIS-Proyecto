<?php
    class TipoContactoMM extends Conectar{

        public function get_TipoContactosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_contacto";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function get_TipoContactoMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_contacto WHERE tbl_tipo_contacto.Id_Tipo_Contacto LIKE :busqueda OR
            tbl_tipo_contacto.Nombre_tipo_contacto LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_TipoContactoMMeditar($Id_Tipo_Contacto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_tipo_contacto WHERE Id_Tipo_Contacto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Contacto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_TipoContactoMM($Nombre_tipo_contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_tipo_contacto(Nombre_tipo_contacto)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_tipo_contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_TipoContactoMM($Id_Tipo_Contacto,$Nombre_tipo_contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_tipo_contacto SET Nombre_tipo_contacto=? WHERE Id_Tipo_Contacto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_tipo_contacto);
            $sql->bindValue(2, $Id_Tipo_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_TipoContactoMM($Id_Tipo_Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_tipo_contacto WHERE Id_Tipo_Contacto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>