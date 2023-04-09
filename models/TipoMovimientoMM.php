<?php
    class TipoMovimientoMM extends Conectar{

        public function get_TipoMovimientosMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_movimiento";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
        
        public function get_TipoMovimientoMM($busqueda){      //Si se nececita mostrar nombre en vez de ID. 
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_movimiento WHERE tbl_tipo_movimiento.Id_Tipo_Movimiento LIKE :busqueda OR
            tbl_tipo_movimiento.Descripcion LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_TipoMovimientoMMeditar($Id_Tipo_Movimiento){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_tipo_movimiento WHERE Id_Tipo_Movimiento=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Movimiento);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_TipoMovimientoMM($Descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_tipo_movimiento(Descripcion)
            VALUES (?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Descripcion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_TipoMovimientoMM($Id_Tipo_Movimiento,$Descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_tipo_movimiento SET Descripcion=? WHERE Id_Tipo_Movimiento=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Descripcion);
            $sql->bindValue(2, $Id_Tipo_Movimiento);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_TipoMovimientoMM($Id_Tipo_Movimiento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_tipo_movimiento WHERE Id_Tipo_Movimiento =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Tipo_Movimiento);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
      
    }
?> 