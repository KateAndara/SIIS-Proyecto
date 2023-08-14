<?php

    class Bitacora extends Conectar{
        
        public function get_Bitacoras(){
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT t1.*, t2.Usuario, t3.Objeto
            FROM tbl_ms_bitacora t1                              
            JOIN tbl_ms_usuarios t2 ON t1.Id_Usuario = t2.Id_Usuario
            JOIN tbl_objetos t3 ON t1.Id_Objeto = t3.Id_Objeto
            ORDER BY t1.Fecha DESC"; // Ordenar por el campo "Fecha" de manera descendente (del más reciente al más viejo)
            $sql = $conexion->prepare($sql);
            $sql->execute();
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
        
            // Formatear la fecha en cada resultado
            foreach ($resultados as &$resultado) {
                $fecha_dt = new DateTime($resultado['Fecha']);  
                $fecha_dt->setTimezone(new DateTimeZone('America/Tegucigalpa'));
                $fecha_formateada = $fecha_dt->format('d-m-Y');
                $resultado['Fecha'] = $fecha_formateada;
            }
        
            return $resultados;
        }
        
        

        public function get_Bitacora($Id_bitacora){    //Si se nececita mostrar nombre en vez de ID.         
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_ms_bitacora WHERE Id_bitacora=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_bitacora);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        
        
    }

    
?>