<?php
    class Clientes extends Conectar{ 

        

        public function get_clientes(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_clientes WHERE Estado = 'activo'";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function verficaDNI($DNI){   //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_clientes 
                    WHERE DNI =? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $DNI);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function verficaDNI2($DNI,$idCliente){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_clientes 
                    WHERE DNI =? && Id_Cliente!=? && Estado = 'activo'"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $DNI);
            $sql->bindValue(2, $idCliente);

            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_cliente($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion(); 
            parent::set_names();
        
            // Verificar si la búsqueda es un número o una cadena
            if (is_numeric($busqueda)) {
                $sql = "SELECT * 
                        FROM tbl_clientes  
                        WHERE Id_Cliente=?" ;
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            } else {
                $sql = "SELECT * 
                        FROM tbl_clientes
                        WHERE Nombre=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            }
        
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        
        public function get_clienteeditar($Id_Cliente){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_clientes
                    WHERE Id_Cliente=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cliente);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_cliente($Nombre_cliente, $Fecha_nacimiento,$DNI){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_clientes(Nombre, Fecha_nacimiento,DNI,Estado)
            VALUES (?,?,?,'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cliente);
            $sql->bindValue(2, $Fecha_nacimiento);
            $sql->bindValue(3, $DNI);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_cliente($Id_Cliente, $Nombre_cliente, $Fecha_nacimiento, $DNI){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_clientes SET Nombre=?, Fecha_nacimiento=?, DNI=? WHERE Id_Cliente=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cliente);
            $sql->bindValue(2, $Fecha_nacimiento);
            $sql->bindValue(3, $DNI);
            $sql->bindValue(4, $Id_Cliente);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_cliente($Id_Cliente){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_clientes SET Estado = 'inactivo' WHERE Id_Cliente =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cliente);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        //Bitácora 
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
        public function clienteeliminar($Id_Cliente){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre FROM tbl_clientes WHERE Id_Cliente = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Cliente, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre'];
                    } else {
                        return "El cliente con Id_Cliente = $Id_Cliente no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }
?>
