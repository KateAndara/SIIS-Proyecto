<?php
    class EditarProcesoProduccion extends Conectar{

        public function get_procesosProduccion() {                        
            $conexion = parent::Conexion();
            parent::set_names();
            date_default_timezone_set('America/Tegucigalpa'); // Configuración de la zona horaria
            
            $sql = "SELECT t1.*, t2.Descripcion as Descripcion
                    FROM tbl_proceso_produccion t1                              
                    JOIN tbl_estado_proceso t2 ON t1.Id_Estado_Proceso = t2.Id_Estado_Proceso";
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
        
        public function get_procesoProduccionEditar($Id_Proceso_Produccion){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_proceso_produccion.*, tbl_estado_proceso.Descripcion 
                    FROM tbl_proceso_produccion 
                    INNER JOIN tbl_estado_proceso 
                    ON tbl_proceso_produccion.Id_Estado_Proceso = tbl_estado_proceso.Id_Estado_Proceso 
                    WHERE tbl_proceso_produccion.Id_Proceso_Produccion=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Proceso_Produccion);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_procesoProduccion($Id_Proceso_Produccion, $Id_Estado_Proceso, $Fecha) {
            $conectar = parent::conexion();
            parent::set_names();
        
            // Formatear la fecha al formato yyyy-mm-dd
            $fechaFormateada = date("Y-m-d", strtotime(str_replace('/', '-', $Fecha)));
        
            $sql = "UPDATE tbl_proceso_produccion SET Id_Estado_Proceso=?, Fecha=? WHERE Id_Proceso_Produccion=?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $Id_Estado_Proceso);
            $sql->bindValue(2, $fechaFormateada); // Usar la fecha formateada
            $sql->bindValue(3, $Id_Proceso_Produccion);
            $sql->execute();
        
            return $resultado = $sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        
        public function get_estadoProceso(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_proceso";          
            $sql= $conexion->prepare($sql);
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
    }
?>