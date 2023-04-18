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

        public function selectTipo($nombreTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_tipo_movimiento 
                    WHERE Descripcion =?"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectTipo2($nombreTipo,$idTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_tipo_movimiento 
                    WHERE Descripcion =? && Id_Tipo_Movimiento!=?"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->bindValue(2, $idTipo);

            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_bitacora($id_usuario, $id_objeto, $accion, $descripcion){
            $conexion= parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) 
                  VALUES (:id_usuario, :id_objeto, :fecha, :accion, :descripcion)";
            $stmt= $conexion->prepare($sql);
            $fecha = date("Y-m-d H:i:s");
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_objeto", $id_objeto, PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $stmt->bindParam(":accion", $accion, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->execute();
        }
        public function get_user($user){
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = ?";
            $stmt = $conexion->prepare($sql);
            if ($stmt) {
                $stmt->bindValue(1, $user, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado['Id_Usuario'];
            } else {
                return null;
            }
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

        public function update_TipoMovimientoMM($Descripcion,$Id_Tipo_Movimiento){
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