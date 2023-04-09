<?php
    class TipoProductoMM extends Conectar{


        public function get_TipoProductosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_producto";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
        
        public function get_TipoProductoMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_producto WHERE tbl_tipo_producto.Id_Tipo_Producto LIKE :busqueda OR
            tbl_tipo_producto.Nombre_tipo LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_TipoProductoMMeditar($Id_Tipo_Producto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_tipo_producto WHERE Id_Tipo_Producto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Producto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_TipoProductoMM($Nombre_tipo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_tipo_producto(Nombre_tipo)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_tipo);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_TipoProductoMM($Id_Tipo_Producto,$Nombre_tipo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_tipo_producto SET Nombre_tipo=? WHERE Id_Tipo_Producto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_tipo);
            $sql->bindValue(2, $Id_Tipo_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_TipoProductoMM($Id_Tipo_Producto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_tipo_producto WHERE Id_Tipo_Producto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?>

