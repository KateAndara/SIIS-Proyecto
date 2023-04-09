<?php
    class EstadoVentaMM extends Conectar{

        public function get_EstadosVentaMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_venta";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function get_EstadoVentaMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_venta WHERE tbl_estado_venta.Id_Estado_Venta LIKE :busqueda OR
            tbl_estado_venta.Nombre_estado LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_EstadoVentaMMeditar($Id_Estado_Venta){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_estado_venta WHERE Id_Estado_Venta=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Venta);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_EstadoVentaMM($Nombre_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_estado_venta(Nombre_estado)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_estado);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_EstadoVentaMM($Id_Estado_Venta,$Nombre_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_estado_venta SET Nombre_estado=? WHERE Id_Estado_Venta=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_estado);
            $sql->bindValue(2, $Id_Estado_Venta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_EstadoVentaMM($Id_Estado_Venta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_estado_venta WHERE Id_Estado_Venta =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Estado_Venta);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?>
