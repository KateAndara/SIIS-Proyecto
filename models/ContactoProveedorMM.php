<?php
    class ContactoProveedorMM extends Conectar{


        public function get_ContactoProveedoresMM($id_proveedor){                  //Si se nececita mostrar nombre en vez de ID.         
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre_tipo_contacto, t3.Nombre
                  FROM tbl_proveedores_contacto t1                              
                  JOIN tbl_tipo_contacto t2 ON t1.Id_Tipo_Contacto = t2.Id_Tipo_Contacto 
                  JOIN tbl_proveedores t3 ON t1.Id_Proveedor = t3.Id_Proveedor where t1.Id_Proveedor=:id_proveedor" ;
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':id_proveedor',$id_proveedor);
           

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
        public function proveedorcontactoeliminar($Id_Proveedores_Contacto){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Contacto FROM tbl_proveedores_contacto WHERE Id_Proveedores_Contacto = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Proveedores_Contacto, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Contacto'];
                    } else {
                        return "El contacto del proveedor  con Id_Proveedores_Contacto = $Id_Proveedores_Contacto no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        // Función para obtener el nombre del proveedor a partir del Id_Proveedor
        public function obtener_nombre_proveedor_por_id($Id_Proveedores_Contacto) {
            $conexion = parent::Conexion();
            $sql = "SELECT Nombre FROM tbl_proveedores WHERE Id_Proveedor = :id";
            $query = $conexion->prepare($sql);
            $query->bindParam(":id", $Id_Proveedores_Contacto, PDO::PARAM_INT);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);

            // Si se encontró el proveedor, retornar su nombre; de lo contrario, retornar una cadena vacía
            return ($resultado) ? $resultado['Nombre'] : '';
        }
        public function get_ContactoProveedorMM($busqueda){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT tbl_proveedores_contacto.*, tbl_proveedores.Nombre, tbl_tipo_contacto.Nombre_tipo_contacto
                    FROM tbl_proveedores_contacto 
                    INNER JOIN tbl_proveedores 
                    ON tbl_proveedores_contacto.Id_Proveedor = tbl_proveedores.Id_Proveedor 
                    INNER JOIN tbl_tipo_contacto  
                    ON tbl_proveedores_contacto.Id_Tipo_Contacto = tbl_tipo_contacto.Id_Tipo_Contacto 
                    WHERE tbl_proveedores_contacto.Id_Proveedores_Contacto LIKE :busqueda OR 
                        tbl_tipo_contacto.Nombre_tipo_contacto LIKE :busqueda OR 
                        tbl_proveedores.Nombre LIKE :busqueda OR 
                        tbl_proveedores_contacto.Contacto LIKE :busqueda";
        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_ContactoProveedorMMeditar($Id_Proveedores_Contacto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_proveedores_contacto.*, tbl_proveedores.Nombre 
                    FROM tbl_proveedores_contacto 
                    INNER JOIN tbl_proveedores 
                    ON tbl_proveedores_contacto.Id_Proveedor = tbl_proveedores.Id_Proveedor 
                    INNER JOIN tbl_tipo_contacto  
                    ON tbl_proveedores_contacto.Id_Tipo_Contacto = tbl_tipo_contacto.Id_Tipo_Contacto
                    WHERE tbl_proveedores_contacto.Id_Proveedores_Contacto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Proveedores_Contacto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_ContactoProveedorMM($Id_Tipo_Contacto, $Id_Proveedor, $Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_proveedores_contacto(Id_Tipo_Contacto, Id_Proveedor, Contacto)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Tipo_Contacto);
            $sql->bindValue(2, $Id_Proveedor);
            $sql->bindValue(3, $Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_ContactoProveedorMM($Id_Proveedores_Contacto, $Id_Tipo_Contacto, $Id_Proveedor, $Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_proveedores_contacto SET Id_Tipo_Contacto=?, Id_Proveedor=?, Contacto=? WHERE Id_Proveedores_Contacto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Tipo_Contacto);
            $sql->bindValue(2, $Id_Proveedor);
            $sql->bindValue(3, $Contacto);
            $sql->bindValue(4, $Id_Proveedores_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_ContactoProveedorMM($Id_Proveedores_Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_proveedores_contacto WHERE Id_Proveedores_Contacto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Proveedores_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_Contactos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_contacto";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_Proveedores(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_proveedores";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>