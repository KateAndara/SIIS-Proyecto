<?php
    class Inventario extends Conectar{
               
        public function get_Inventarios(){                 
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.* 
                  FROM tbl_inventario t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto";
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
        public function getMovimientos($idProducto){ 
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.*, t3.Usuario AS Nom_Usuario
            FROM tbl_kardex t1                              
            JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
            JOIN tbl_ms_usuarios t3 ON t1.Id_Usuario = t3.Id_Usuario
            where t1.Id_Producto=$idProducto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
                            
    }
?>