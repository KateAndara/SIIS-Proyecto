<?php
session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
        die();
     }
        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json');

        require_once '../config/conexion3.php';
        require_once '../models/GestionProcesoProduccion.php';

        $procesos = new EditarProcesoProduccion();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProcesosProduccion":
                $datos=$procesos->get_procesosProduccion();

                 //ciclo for para insertar los botontes en cada opción
                 for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<div style="display: flex; align-items: center;">' . '<button class="rounded" style="background-color: #2D7AC0; color: white; width: 73px; margin-right: 4px;" onclick="CargarProcesoProduccion(\'' .$datos[$i]['Id_Proceso_Produccion']. '\'); CargarProductosTerminadosMPEditandoProceso(\'' .$datos[$i]['Id_Proceso_Produccion']. '\');  CargarProductosTerminadosFinalEditandoProceso(\'' .$datos[$i]['Id_Proceso_Produccion']. '\'); mostrarDiv();">Editar</button>';
                    }

                    //si permisos es igual a Permiso_visualizacion crea el boton
                    if($_SESSION['permisosMod']['c']){
                        $btnView = '<button class="rounded" style="background-color: #FF0000; color: white; width: 80px; margin-right: 4px;" onclick="procesoProduccionPDF(\''  .$datos[$i]['Id_Proceso_Produccion']."')\">PDF ".'<i class="fa-regular fa-file-pdf"></i>'."</button>'";
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; width: 80px; margin-right: 4px;" onclick="CancelarProcesoProduccion(\''.$datos[$i]['Id_Proceso_Produccion']."')\">Cancelar</button>"."</div>'";
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnEdit.' '.$btnView.' '.$btnDelete.'</div>';

                }


                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($procesos->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_proceso_produccion'])) {
                    $procesos->registrar_bitacora($Id_Usuario, 32,  'Ingresar', 'Se ingresó a la pantalla del proceso de producción ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_proceso_produccion'] = true;
                }





                echo json_encode($datos);
            break;
            //Datos de otra tabla
            case "GetEstadosProcesos":
                $datos=$procesos->get_estadoProceso();
                echo json_encode($datos);
            break;
            case "GetProcesoProduccionEditar": //Trae la fila que se va a editar
                $datos=$procesos->get_procesoProduccionEditar($body["Id_Proceso_Produccion"]);
                echo json_encode($datos);
            break;
            case "UpdateProcesoProduccion":
                $datos=$procesos->update_procesoProduccion($body["Id_Proceso_Produccion"],$body["Id_Estado_Proceso"],$body["Fecha"]);
                echo json_encode("Proceso Actualizado");
            break;
        }

?>   
