<?php
    class Promociones extends Conectar{

        public function get_promociones(){                      
            $conexion = parent::Conexion();
            parent::set_names();
            date_default_timezone_set('America/Tegucigalpa'); // Configuración de la zona horaria
            
            $sql = "SELECT * FROM tbl_promociones WHERE Estado = 'activo'";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Formatear las fechas en cada resultado
            foreach ($resultados as &$resultado) {
                $fecha_inicio_dt = new DateTime($resultado['Fecha_inicio']);  
                $fecha_inicio_dt->setTimezone(new DateTimeZone('America/Tegucigalpa'));
                $fecha_inicio_formateada = $fecha_inicio_dt->format('d-m-Y');
                $resultado['Fecha_inicio'] = $fecha_inicio_formateada;
        
                $fecha_final_dt = new DateTime($resultado['Fecha_final']);  
                $fecha_final_dt->setTimezone(new DateTimeZone('America/Tegucigalpa'));
                $fecha_final_formateada = $fecha_final_dt->format('d-m-Y');
                $resultado['Fecha_final'] = $fecha_final_formateada;
            }
            
            return $resultados;                
        }
        

        public function get_promocion($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion();
            parent::set_names();
        
            $arrPromocion=[];
            $sql="SELECT * FROM  tbl_promociones  WHERE c.Id_Promocion=$busqueda";          
            $sql= $conectar->prepare($sql);
            $sql->execute();
            $resultadopromocion= $sql->fetchAll(PDO::FETCH_ASSOC);
            $arrPromocion['Promocion']=$resultadopromocion;
            return $arrPromocion;
        }
        public function get_promocioneditar($Id_Promocion){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_promociones
                    WHERE Id_Promocion=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_promocion($Nombre_Promocion, $Precio_Venta, $Fecha_inicio, $Fecha_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_promociones(Nombre_Promocion, Precio_Venta, Fecha_inicio, Fecha_final, Estado)
            VALUES (?,?,?,?,'activo');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Promocion);
            $sql->bindValue(2, $Precio_Venta);
            $sql->bindValue(3, $Fecha_inicio);
            $sql->bindValue(4, $Fecha_final);
            $sql->execute();
            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
            $resultado = $conectar->lastInsertId();
            return $resultado;
        }

        public function update_promocion($Id_Promocion, $Nombre_Promocion, $Precio_Venta, $Fecha_inicio, $Fecha_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_promociones SET Nombre_Promocion=?, Precio_Venta=?, Fecha_inicio=?, Fecha_final=? WHERE Id_Promocion=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Promocion);
            $sql->bindValue(2, $Precio_Venta);
            $sql->bindValue(3, $Fecha_inicio);
            $sql->bindValue(4, $Fecha_final);
            $sql->bindValue(5, $Id_Promocion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_promocion($Id_Promocion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE tbl_promociones SET Estado = 'inactivo' WHERE Id_Promocion =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        //Bitácora 
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
        public function promocióneliminar($Id_Promocion){       
            try {
                $conectar = parent::Conexion();
                parent::set_names();
                $sql = "SELECT Nombre_Promocion FROM tbl_promociones WHERE Id_Promocion = ?";
                $sql = $conectar->prepare($sql);
                if ($sql) {
                    $sql->bindValue(1, $Id_Promocion, PDO::PARAM_STR);
                    $sql->execute();
                    
                    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        return $resultado['Nombre_Promocion'];
                    } else {
                        return "El contacto del proveedor  con Id_Proveedores_Contacto = $Id_Promocion no existe.";
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
