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

        public function selectTipo($nombreTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_tipo_producto 
                    WHERE Nombre_tipo =?"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombreTipo);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectTipo2($nombreTipo,$idTipo){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_tipo_producto 
                    WHERE Nombre_tipo =? && Id_Tipo_Producto!=?"; 
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
        public function tipoproductoeliminar($Id_Tipo_Producto){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre_tipo FROM tbl_tipo_producto WHERE Id_Tipo_Producto = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Tipo_Producto, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre_tipo'];
                    } else {
                        return "La pregunta con Id_Pregunta = $Id_Tipo_Producto no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
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

        public function update_TipoProductoMM($Nombre_tipo,$Id_Tipo_Producto){
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

