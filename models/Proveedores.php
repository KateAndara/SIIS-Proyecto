<?php
    class Proveedor extends Conectar{

        public function get_proveedores(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_proveedores";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_proveedor($busqueda){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_proveedores 
                    WHERE Id_Proveedor LIKE :busqueda OR 
                          Nombre LIKE :busqueda OR 
                          RTN LIKE :busqueda";        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_proveedoreditar($Id_Proveedor){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_proveedores
                    WHERE Id_Proveedor=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Proveedor);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_proveedor($Nombre, $RTN){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_proveedores(Nombre, RTN)
            VALUES (?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre);
            $sql->bindValue(2, $RTN);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_proveedor($Id_Proveedor, $Nombre, $RTN){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_proveedores SET Nombre=?, RTN=? WHERE Id_Proveedor=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre);
            $sql->bindValue(2, $RTN);
            $sql->bindValue(3, $Id_Proveedor);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_proveedor($Id_Proveedor){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_proveedores WHERE Id_Proveedor =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Proveedor);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>