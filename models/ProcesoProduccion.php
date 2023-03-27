<?php
    class ProcesoProduccion extends Conectar{

        public function insert_productoTerminadoMP($Id_Producto, $Id_Proceso_Produccion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_producto_terminado_mp(Id_Producto, Id_Proceso_Produccion, Cantidad)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Proceso_Produccion);
            $sql->bindValue(3, $Cantidad);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function insert_productoTerminadoFinal($Id_Producto, $Id_Proceso_Produccion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_producto_terminado_final(Id_Producto, Id_Proceso_Produccion, Cantidad)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Proceso_Produccion);
            $sql->bindValue(3, $Cantidad);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function insert_procesoProduccion($Id_Estado_Proceso, $Fecha){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_proceso_produccion(Id_Estado_Proceso, Fecha)
            VALUES (?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Estado_Proceso);
            $sql->bindValue(2, $Fecha);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_productos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_estadoProceso(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_proceso";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>