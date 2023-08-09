<?php
    class Producto extends Conectar{

        public function get_productos(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre_tipo
                  FROM tbl_productos t1                              
                  JOIN tbl_tipo_producto t2 ON t1.Id_Tipo_Producto = t2.Id_Tipo_Producto
                  WHERE t1.Estado = 'activo'";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
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

        public function productoeliminar($Id_Producto){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre FROM tbl_productos WHERE Id_Producto = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Producto, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre'];
                    } else {
                        return "El producto con Id_Producto = $Id_Producto no existe.";
                    }
                } else {
                    return "Error al preparar la consulta.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }
        public function get_producto($busqueda){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos 
                    WHERE Id_Producto LIKE :busqueda OR
                          Nombre_tipo LIKE :busqueda OR
                          Nombre LIKE :busqueda OR
                          Unidad_medida LIKE :busqueda OR
                          Precio LIKE :busqueda OR
                          Cantidad_maxima LIKE :busqueda OR
                          Cantidad_minimma LIKE :busqueda";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }           

        public function get_productoeditar($Id_Producto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_productos.*, tbl_tipo_producto.Nombre_tipo
                    FROM tbl_productos
                    INNER JOIN tbl_tipo_producto
                    ON tbl_productos.Id_Tipo_Producto = tbl_tipo_producto.Id_Tipo_Producto 
                    WHERE tbl_productos.Id_Producto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_producto($Id_Tipo_Producto, $Nombre, $Unidad_medida, $Precio, $Cantidad_maxima, $Cantidad_minima){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_productos(Id_Tipo_Producto, Nombre, Unidad_medida, Precio, Cantidad_maxima, Cantidad_minima)
            VALUES (?,?,?,?,?,?);";
            $sql=$conectar->prepare($sql);            
            $sql->bindValue(1, $Id_Tipo_Producto);
            $sql->bindValue(2, $Nombre);
            $sql->bindValue(3, $Unidad_medida);
            $sql->bindValue(4, $Precio);
            $sql->bindValue(5, $Cantidad_maxima);
            $sql->bindValue(6, $Cantidad_minima);
            $resultado = $sql->execute();
            $idProducto=$conectar->lastInsertId();

            $sql="INSERT INTO `tbl_inventario` (`Id_Producto`, `Existencia`) VALUES (?,?);";
            $sql=$conectar->prepare($sql);            
            $sql->bindValue(1, $idProducto);
            $sql->bindValue(2, 0);
            $resultado = $sql->execute();

            return $resultado;
        }

        public function update_producto($Id_Producto, $Id_Tipo_Producto, $Nombre, $Unidad_medida, $Precio, $Cantidad_maxima, $Cantidad_minima){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_productos SET Id_Tipo_Producto=?, Nombre=?, Unidad_medida=?, Precio=?, Cantidad_maxima=?, Cantidad_minima=? WHERE Id_Producto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Tipo_Producto);
            $sql->bindValue(2, $Nombre);
            $sql->bindValue(3, $Unidad_medida);
            $sql->bindValue(4, $Precio);
            $sql->bindValue(5, $Cantidad_maxima);
            $sql->bindValue(6, $Cantidad_minima);
            $sql->bindValue(7, $Id_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        

        public function delete_producto($Id_Producto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_productos WHERE Id_Producto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_tipoproductos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_producto";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    
    }
?>