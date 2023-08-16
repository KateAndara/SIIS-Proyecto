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
        require_once '../models/Preguntas.php';
       

        $Preguntas = new Pregunta();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPreguntas":
                $datos=$Preguntas->get_preguntas();
                

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPregunta(\'' .$datos[$i]['Id_Pregunta']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPregunta(\'' .$datos[$i]['Id_Pregunta']. '\')">Eliminar</button>';
                    }
                
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Preguntas->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_preguntas'])) {
                    $Preguntas->registrar_bitacora($Id_Usuario, 31,  'Ingresar', 'Se ingresó a la pantalla de preguntas ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_preguntas'] = true;
                }
                echo json_encode($datos);
            break;
            case "GetPregunta":
                $busqueda = isset($body["Pregunta"]) ? $body["Pregunta"] : (isset($body["Id_Pregunta"]) ? $body["Id_Pregunta"] : '');
                $datos=$Preguntas->get_pregunta($body[$busqueda]);
                echo json_encode($datos);
            break;
            case "GetPreguntaeditar": //Trae la fila que se va a editar
                $datos=$Preguntas->get_preguntaeditar($body["Id_Pregunta"]);
                echo json_encode($datos);
            break;
            case "InsertPregunta":
                // Obtiene el texto de la pregunta desde el cuerpo de la solicitud
                $Pregunta = $body["Pregunta"];
            
                // Llama al método para insertar la pregunta y registrar la bitácora
                $datos = $Preguntas->insert_pregunta($Pregunta);
            
                // Obtiene el Id_Usuario de la sesión
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Preguntas->get_user($varsesion));
            
                // Llama al método para registrar la bitácora con la información de la pregunta insertada
                $Preguntas->registrar_bitacora($Id_Usuario, 31, 'Insertar', 'Se insertó la pregunta: ' . $Pregunta);
            
                echo json_encode("Se agregó la pregunta");
            break;
            
            case "UpdatePregunta":
                $datos=$Preguntas->update_pregunta($body["Id_Pregunta"],$body["Pregunta"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Preguntas->get_user($varsesion));
                $Preguntas->registrar_bitacora($Id_Usuario, 31, 'Actualizar', 'Se actualizó la pregunta ' .$body["Pregunta"]);
                echo json_encode("Pregunta Actualizada");
            break;
            case "DeletePregunta":
                // Obtiene el Id_Pregunta desde el cuerpo de la solicitud
                $Id_Pregunta = $body["Id_Pregunta"];
            
                // Obtén la pregunta antes de eliminarla
                $pregunta_eliminada = $Preguntas->preguntaeliminar($Id_Pregunta);
            
                // Llama al método para eliminar la pregunta
                $datos = $Preguntas->delete_pregunta($Id_Pregunta);
            
                // Obtiene el Id_Usuario de la sesión
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Preguntas->get_user($varsesion));
            
                // Llama al método para registrar la bitácora con la información de la pregunta eliminada
                $Preguntas->registrar_bitacora($Id_Usuario, 31, 'Eliminar', 'Se eliminó la pregunta: ' . $pregunta_eliminada);
                
            
                echo json_encode("Pregunta Eliminada");
            break;
            
        }

?>   
