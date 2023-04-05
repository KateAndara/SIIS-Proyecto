<?php
    class Objeto extends Conectar{

        public function get_objetos(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_objetos";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_objeto($busqueda){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_objetos
                    WHERE Id_Objeto LIKE :busqueda OR 
                          Objeto LIKE :busqueda OR 
                          Descripcion LIKE :busqueda OR 
                          Tipo_objeto LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_objetoeditar($Id_Objeto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_objetos 
                    WHERE Id_Objeto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Objeto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_objeto($Objeto, $Descripcion, $Tipo_objeto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_objetos(Objeto, Descripcion, Tipo_objeto)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Objeto);
            $sql->bindValue(2, $Descripcion);
            $sql->bindValue(3, $Tipo_objeto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_objeto($Id_Objeto, $Objeto, $Descripcion, $Tipo_objeto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_objetos SET Objeto=?, Descripcion=?, Tipo_objeto=? WHERE Id_Objeto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Objeto);
            $sql->bindValue(2, $Descripcion);
            $sql->bindValue(3, $Tipo_objeto);
            $sql->bindValue(4, $Id_Objeto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_objeto($Id_Objeto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_objetos WHERE Id_Objeto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Objeto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>