<?php
    class Proveedor extends Conectar{

        public function get_proveedores(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_proveedores where Estado='activo'";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function verficaDNI($RTN){   //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_proveedores 
                    WHERE RTN =? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $RTN);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function verficaDNI2($RTN,$idProveedor){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_proveedores 
                    WHERE RTN =? && Id_Proveedor!=? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $RTN);
            $sql->bindValue(2, $idProveedor);

            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
       public function registrar_bitacora($id_usuario, $id_objeto, $accion, $descripcion) {
            $conexion = parent::Conexion();
            parent::set_names();
            
            $sql = "INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) 
                    VALUES (:id_usuario, :id_objeto, CURRENT_TIMESTAMP(), :accion, :descripcion)";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_objeto", $id_objeto, PDO::PARAM_INT);
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
        public function proveedoreliminar($Id_Proveedor){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre FROM tbl_proveedores WHERE Id_Proveedor = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Proveedor, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre'];
                    } else {
                        return "El proveedor con Id_Proveedor = $Id_Proveedor no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
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
            $sql="INSERT INTO tbl_proveedores(Nombre, RTN, Estado)
            VALUES (?,?, 'activo');";
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
            $sql = "UPDATE tbl_proveedores SET Estado = 'inactivo' WHERE Id_Proveedor =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Proveedor);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>