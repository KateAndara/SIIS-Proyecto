<?php
    class PromocionesProductos extends Conectar{

        public function get_promocionesProductos() {
            $conexion = parent::Conexion();
            parent::set_names();
            
            $sql = "SELECT a.Id_Promocion_Producto, c.Nombre AS NombreProducto, b.Nombre_Promocion, a.Cantidad 
                    FROM tbl_promocion_producto a 
                    INNER JOIN tbl_promociones b ON a.Id_Promocion = b.Id_Promocion
                    INNER JOIN tbl_productos c ON a.Id_Producto = c.Id_Producto
                    WHERE b.Estado = 'activo' AND a.Estado = 'activo'";
            
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
              

        public function insert_promocionProducto($Id_Producto, $Id_Promocion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_promocion_producto(Id_Producto, Id_Promocion, Cantidad, Estado)
            VALUES (?,?,?,'activo');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Promocion);
            $sql->bindValue(3, $Cantidad);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_promocionProductoEditar($Id_Promocion_Producto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_promocion_producto
                    WHERE Id_Promocion_Producto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion_Producto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_promocionProducto($Id_Promocion_Producto, $Id_Producto, $Id_Promocion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_promocion_producto SET Id_Producto=?, Id_Promocion=?, Cantidad=? WHERE Id_Promocion_Producto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Promocion);
            $sql->bindValue(3, $Cantidad);
            $sql->bindValue(4, $Id_Promocion_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_promocionProducto($Id_Promocion_Producto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_promocion_producto SET Estado = 'inactivo' WHERE Id_Promocion_Producto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion_Producto);
            $sql->execute();
            return true;
        }

        public function get_productosTerminados(){    
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_productos WHERE Id_Tipo_Producto = 1 AND Estado = 'activo'";
            $sql = $conexion->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_promociones(){    
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_promociones WHERE Estado = 'activo'";
            $sql = $conexion->prepare($sql);
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
        function obtenerNombrePromocion($idPromocion) {
            // Aquí realizas la consulta a la base de datos para obtener el nombre de la promoción
            $conexion = parent::Conexion();
            $sql = "SELECT Nombre_Promocion FROM tbl_promociones WHERE Id_Promocion = :idPromocion";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':idPromocion', $idPromocion, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $resultado['Nombre_Promocion'];
        }
        
        function obtenerNombreProducto($idProducto) {
            // Aquí realizas la consulta a la base de datos para obtener el nombre del producto
            $conexion = parent::Conexion();
            $sql = "SELECT Nombre FROM tbl_productos WHERE Id_Producto = :idProducto";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $resultado['Nombre'];
        }
        
    }
?>