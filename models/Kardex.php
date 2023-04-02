<?php
    class Kardex extends Conectar{

        /*public function get_Kardexs(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_kardex";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/
        public function get_Kardexs(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre, t3.Descripcion
                  FROM tbl_kardex t1                              
                  JOIN tbl_productos t2 ON t1.Id_Producto = t2.Id_Producto
                  JOIN tbl_tipo_movimiento t3 ON t1.Id_Tipo_Movimiento = t3.Id_Tipo_Movimiento";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
        
        public function get_Kardex($Id_Kardex){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_kardex WHERE Id_Kardex=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Kardex);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
                
    }
?>