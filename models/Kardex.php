<?php
    class Kardex extends Conectar{

        public function get_Kardexs(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre, t3.Descripcion, t4.Usuario
                  FROM tbl_kardex t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
                  JOIN tbl_tipo_movimiento t3 ON t1.Id_Tipo_Movimiento = t3.Id_Tipo_Movimiento
                  JOIN tbl_ms_usuarios t4 ON t1.Id_Usuario = t4.Id_Usuario";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);     
        }     
             
    }
?>